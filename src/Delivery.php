<?php

namespace Sashalenz\Delivery;

use Sashalenz\Delivery\ApiModels\Receipt;
use Sashalenz\Delivery\ApiModels\Warehouse;

final class Delivery
{
    public const CURRENCY = 100000000;

    public static function warehouse(): Warehouse
    {
        return new Warehouse();
    }

    public static function receipt(): Receipt
    {
        return new Receipt();
    }
}
