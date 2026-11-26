<?php

namespace App\Enums;

enum VehicleType: string
{
    case Motorcycle = 'motorcycle';
    case Scooter = 'scooter';
    case SparePart = 'spare_part';
    case Battery = 'battery';
    case Charger = 'charger';
    case Accessory = 'accessory';

    public function label(): string
    {
        return match ($this) {
            self::Motorcycle => 'Motorcycle',
            self::Scooter => 'Scooter',
            self::SparePart => 'Spare Part',
            self::Battery => 'Battery',
            self::Charger => 'Charger',
            self::Accessory => 'Accessory',
        };
    }
}
