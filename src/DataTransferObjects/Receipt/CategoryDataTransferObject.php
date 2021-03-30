<?php

namespace Sashalenz\Delivery\DataTransferObjects\Receipt;

use Sashalenz\Delivery\DataTransferObjects\DeliveryDataTransferObject;

class CategoryDataTransferObject extends DeliveryDataTransferObject
{
    public string $categoryId;
    public string $categoryIdName;
    public int $classification;
    public int $countPlace;
    public ?float $helf;
    public ?float $size;
    public ?float $height;
    public ?float $lenght;
    public ?float $width;
    public ?float $helfTarif;
    public ?float $egTarif;
    public ?float $oformlenie;
    public ?float $oformlenieCost;
    public ?float $deliveryCost;
    public ?float $documentCost;
    public string $comment;

    public static function fromArray(array $array): self
    {
        return new self([
            'categoryId' => $array['categoryId'],
            'categoryIdName' => $array['categoryIdName'],
            'classification' => (int) $array['classification'],
            'countPlace' => $array['countPlace'],
            'helf' => $array['helf'],
            'size' => $array['size'],
            'height' => $array['height'],
            'lenght' => $array['lenght'],
            'width' => $array['width'],
            'helfTarif' => $array['helfTarif'],
            'egTarif' => $array['egTarif'],
            'oformlenie' => $array['oformlenie'],
            'oformlenieCost' => $array['oformlenieCost'],
            'deliveryCost' => $array['deliveryCost'],
            'documentCost' => $array['documentCost'],
            'comment' => $array['comment'],
        ]);
    }
}
