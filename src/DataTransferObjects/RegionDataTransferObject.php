<?php

namespace Sashalenz\Delivery\DataTransferObjects;

class RegionDataTransferObject extends DeliveryDataTransferObject
{
    public int $id;
    public string $name;
    public string $externalId;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => (int) $array['id'],
            'name' => $array['name'],
            'externalId' => $array['description'],
        ]);
    }
}
