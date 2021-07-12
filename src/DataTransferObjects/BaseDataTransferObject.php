<?php

namespace Sashalenz\Delivery\DataTransferObjects;

use Sashalenz\Delivery\DataTransferObjects\DeliveryDataTransferObject;

class BaseDataTransferObject extends DeliveryDataTransferObject
{
    public string $id;
    public string $name;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => $array['id'],
            'name' => $array['name']
        ]);
    }
}
