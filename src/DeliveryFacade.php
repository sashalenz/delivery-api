<?php

namespace Sashalenz\Delivery;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sashalenz\Delivery\Delivery
 */
class DeliveryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'delivery-api';
    }
}
