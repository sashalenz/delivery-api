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
    public string $email;
    public string $operatingTime;
    public string $phone;
    public string $emailStorage;
    public bool $office;
    public string $cityName;
    public bool $isWarehouse;
    public string $rcPhoneSecurity;
    public string $rcPhoneManagers;
    public string $rcPhone;
    public string $rcName;
    public string $warehouseForDeliveryId;
    public int $warehouseType;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => $array['id'],
            'name' => $array['name'],
            'latitude' => $array['Latitude'],
            'longitude' => $array['Longitude'],
            'cityId' => $array['CityId'],
            'address' => $array['address'],
            'operatingTime' => $array['operatingTime'],
            'phone' => $array['Phone'],
            'emailStorage' => $array['EmailStorage'],
            'office' => (bool) $array['Office'],
            'cityName' => $array['CityName'],
            'isWarehouse' => (bool) $array['IsWarehouse'],
            'rcPhoneSecurity' => $array['RcPhoneSecurity'],
            'rcPhoneManagers' => $array['RcPhoneManagers'],
            'rcPhone' => $array['RcPhone'],
            'rcName' => $array['RcName'],
            'warehouseForDeliveryId' => $array['WarehouseForDeliveryId'],
            'warehouseType' => (int) $array['WarehouseType'],
        ]);
    }
}
