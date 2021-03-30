<?php

namespace Sashalenz\Delivery;

use Carbon\Carbon;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Sashalenz\Delivery\Exceptions\DeliveryException;

final class Request
{
    private const TIMEOUT = 3;
    private const RETRY_TIMES = 3;
    private const RETRY_SLEEP = 100;

    private string $url;
    private string $method;
    private array $params;
    private bool $auth;

    public function __construct(string $method, array $params, bool $auth)
    {
        $this->method = $method;
        $this->params = $params;
        $this->auth = $auth;

        $this->url = Config::get('delivery-api.url');
    }

    /**
     * @return Collection
     * @throws DeliveryException
     */
    public function make(): Collection
    {
        try {
            $headers = [];

            if ($this->auth) {
                $headers['HMACAuthorization'] = 'amx ' . $this->hash();
            }

            return Http::timeout(self::TIMEOUT)
                ->retry(
                    self::RETRY_TIMES,
                    self::RETRY_SLEEP
                )
                ->baseUrl($this->url)
                ->asJson()
                ->withHeaders($headers)
                ->get(
                    $this->method,
                    $this->params
                )
                ->throw()
                ->collect('data');
        } catch (RequestException $e) {
            throw new DeliveryException('API Exception: ' . $e->getMessage());
        }
    }

    private function hash(): string
    {
        $publicKey = Config::get('delivery-api.public_key');
        $secretKey = Config::get('delivery-api.secret_key');
        $timestamp = Carbon::now()->timestamp;

        return collect([
            $publicKey,
            $timestamp,
            hash_hmac('sha1', $publicKey . $timestamp, $secretKey),
        ])->implode(':');
    }

    public function cache(int $seconds = -1) : Collection
    {
        if ($seconds === -1) {
            return Cache::rememberForever($this->getCacheKey(), fn () => $this->make());
        }

        return Cache::remember($this->getCacheKey(), $seconds, fn () => $this->make());
    }

    private function getCacheKey() : string
    {
        return $this->method.'_'.collect($this->params)->values()->implode('_');
    }
}
