<?php

namespace Sashalenz\Delivery\ApiModels;

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
     * @return string
     * @throws DeliveryException
     */
    public function getDateArrival(): string
    {
        return $this->method('GetDateArrival')
            ->validate([
                'areasSendId' => ['required', 'uuid'],
                'areasResiveId' => ['required', 'uuid'],
                'dateSend' => ['required', 'string'],
                'currency' => ['required', 'int'],
                'warehouseSendId' => ['nullable', 'uuid'],
                'warehouseResiveId' => ['nullable', 'uuid'],
            ])
            ->request()
            ->get('arrivalDate');
    }
}
