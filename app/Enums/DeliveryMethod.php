<?php

namespace App\Enums;

enum DeliveryMethod: string
{
    case Door = 'Door';
    case StopDesk = 'StopDesk';
    case StorePickup = 'store_pickup';
}
