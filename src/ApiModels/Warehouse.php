<?php

namespace Sashalenz\Delivery\ApiModels;

use Illuminate\Support\Collection;
use Sashalenz\Delivery\DataTransferObjects\RegionDataTransferObject;
use Sashalenz\Delivery\Exceptions\DeliveryException;

final class Warehouse extends BaseModel
{
    /**
     * @return Collection
     * @throws DeliveryException
     */
    public function getRegionList(): Collection
    {
        return $this->method('GetRegionList')
            ->validate([
                'country' => ['required', 'numeric', 'in:1,2']
            ])
            ->request()
            ->mapInto(RegionDataTransferObject::class);

//        return RegionDataTransferObject::collectFromArray(
//            $this->method('GetRegionList')
//                ->validate([
//                    'country' => ['required', 'numeric', 'in:1,2']
//                ])
//                ->request()
//                ->toArray()
//        );
    }
}
