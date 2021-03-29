<?php

namespace Sashalenz\Delivery;

use Sashalenz\Delivery\ApiModels\Warehouse;

final class Delivery
{
    public static function warehouse(): Warehouse
    {
        return new Warehouse();
    }
}
