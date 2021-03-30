<?php

namespace Sashalenz\Delivery\DataTransferObjects\Receipt;

use Sashalenz\Delivery\DataTransferObjects\DeliveryDataTransferObject;

class DeliverySchemaDataTransferObject extends DeliveryDataTransferObject
{
    public int $id;
    public string $name;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => (int) $array['id'],
            'name' => $array['name']
        ]);
    }
}
