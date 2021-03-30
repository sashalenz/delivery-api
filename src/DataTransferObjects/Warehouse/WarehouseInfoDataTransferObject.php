<?php

namespace Sashalenz\Delivery\DataTransferObjects\Warehouse;

use Sashalenz\Delivery\DataTransferObjects\DeliveryDataTransferObject;

class WarehouseInfoDataTransferObject extends DeliveryDataTransferObject
{
    public string $id;
    public string $name;
    public float $latitude;
    public float $longitude;
    public string $cityId;
    public string $cityName;
    public string $address;
    public string $operatingTime;
    public string $phone;
    public string $emailStorage;
    public bool $office;
    public bool $isWarehouse;
    public string $rcPhoneSecurity;
    public string $rcPhoneManagers;
    public string $rcPhone;
    public string $rcName;
    public ?string $warehouseForDeliveryId = null;
    public int $warehouseType;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => $array['id'],
            'name' => $array['name'],
            'latitude' => $array['latitude'],
            'longitude' => $array['longitude'],
            'cityId' => $array['CityId'],
            'cityName' => $array['CityName'],
            'address' => $array['address'],
            'operatingTime' => $array['operatingTime'],
            'phone' => $array['Phone'],
            'emailStorage' => $array['EmailStorage'],
            'office' => (bool) $array['Office'],
            'isWarehouse' => (bool) $array['IsWarehouse'],
            'rcPhoneSecurity' => $array['RcPhoneSecurity'],
            'rcPhoneManagers' => $array['RcPhoneManagers'],
            'rcPhone' => $array['RcPhone'],
            'rcName' => $array['RcName'],
            'warehouseForDeliveryId' => $array['WarehouseForDeliveryId'] ?? null,
            'warehouseType' => (int) $array['WarehouseType']
        ]);
    }
}
