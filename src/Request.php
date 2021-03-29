<?php

namespace Sashalenz\Delivery;

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

    private string $publicKey;
    private string $secretKey;
    private string $url;
    private string $method;
    private array $params;

    public function __construct(string $method, array $params)
    {
        $this->method = $method;
        $this->params = $params;

        $this->publicKey = Config::get('delivery-api.key');
        $this->secretKey = Config::get('delivery-api.secret');
        $this->url = Config::get('delivery-api.url');
    }

    /**
     * @return Collection
     * @throws DeliveryException
     */
    public function make(): Collection
    {
        $this->params['public_key'] = $this->publicKey;
        $this->params['secret_key'] = $this->secretKey;

        $link = $this->url . '/' . $this->method;

        try {
            return Http::timeout(self::TIMEOUT)
                ->retry(
                    self::RETRY_TIMES,
                    self::RETRY_SLEEP
                )
                ->asJson()
                ->post(
                    $link,
                    $this->params
                )
                ->throw()
                ->collect('data');
        } catch (RequestException $e) {
            throw new DeliveryException('API Exception: ' . $e->getMessage());
        }
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
