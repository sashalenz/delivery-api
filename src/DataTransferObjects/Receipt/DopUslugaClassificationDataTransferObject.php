<?php

namespace Sashalenz\Delivery\DataTransferObjects\Receipt;

use Illuminate\Support\Collection;
use Sashalenz\Delivery\DataTransferObjects\DeliveryDataTransferObject;

class DopUslugaClassificationDataTransferObject extends DeliveryDataTransferObject
{
    public int $classification;
    public string $name;
    public Collection $dopUsluga;

    public static function fromArray(array $array): self
    {
        return new self([
            'classification' => (int) $array['classification'],
            'uslugaId' => $array['uslugaId'],
            'dopUsluga' => DopUslugaDataTransferObject::collectFromArray($array['dopUsluga'])
        ]);
    }
}
