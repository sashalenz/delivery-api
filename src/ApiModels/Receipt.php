<?php

namespace Sashalenz\Delivery\ApiModels;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Sashalenz\Delivery\DataTransferObjects\Receipt\DopUslugaClassificationDataTransferObject;
use Sashalenz\Delivery\DataTransferObjects\Receipt\ReceiptDataTransferObject;
use Sashalenz\Delivery\Exceptions\DeliveryException;

final class Receipt extends BaseModel
{
    /**
     * @return ReceiptDataTransferObject
     * @throws DeliveryException
     */
    public function getReceiptDetails(): ReceiptDataTransferObject
    {
        return ReceiptDataTransferObject::fromArray(
            $this->method('GetReceiptDetails')
                ->validate([
                    'number' => ['required', 'string'],
                ])
                ->request()
                ->toArray()
        );
    }

    /**
     * @return Carbon
     * @throws DeliveryException
     */
    public function getDateArrival(): Carbon
    {
        return Carbon::parse(
            $this->method('GetDateArrival')
                ->validate([
                    'areasSendId' => ['required', 'uuid'],
                    'areasResiveId' => ['required', 'uuid'],
                    'dateSend' => ['required', 'date', 'date_format:d.m.Y', 'after_or_equal:today'],
                    'currency' => ['required', 'numeric'],
                    'warehouseSendId' => ['nullable', 'uuid'],
                    'warehouseResiveId' => ['nullable', 'uuid'],
                ])
                ->request()
                ->get('arrivalDate')
        );
    }

    /**
     * @return Collection
     * @throws DeliveryException
     */
    public function getDopUslugiClassification(): Collection
    {
        return $this->method('GetDopUslugiClassification')
            ->validate([
                'CitySendId' => ['required', 'uuid'],
                'CityReceiveId' => ['required', 'uuid'],
                'currency' => ['required', 'numeric'],
                'formalization' => ['nullable', 'boolean'],
            ])
            ->request()
            ->map(fn (array $array) => DopUslugaClassificationDataTransferObject::fromArray($array));
    }
}
