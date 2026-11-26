<?php

namespace App\Services;

use App\Models\DeliveryCompany;
use App\Models\DeliveryPrice;
use App\Models\Wilaya;
use Illuminate\Support\Facades\Cache;

class DeliveryService
{
    public function getActiveCompany(): ?DeliveryCompany
    {
        return Cache::remember('delivery.active_company', 3600, function () {
            return DeliveryCompany::with('deliveryPrices.wilaya')
                ->where('is_active', true)
                ->first();
        });
    }

    public function calculatePrice(int $wilayaCode, string $method = 'Door'): float
    {
        $delivery = DeliveryPrice::where('wilaya_code', $wilayaCode)->first();

        if (!$delivery) {
            return 0;
        }

        return match ($method) {
            'Door' => (float) $delivery->door,
            'StopDesk' => (float) $delivery->stopdesk,
            default => 0,
        };
    }

    public function getDeliveryTime(int $wilayaCode): ?string
    {
        $delivery = DeliveryPrice::where('wilaya_code', $wilayaCode)->first();
        return $delivery?->delivery_time;
    }

    public function getAllWilayas()
    {
        return Cache::remember('delivery.wilayas', 86400, function () {
            return Wilaya::with('communes')->orderBy('wilaya_code')->get();
        });
    }

    public function getCommunes(int $wilayaCode)
    {
        return Wilaya::find($wilayaCode)?->communes;
    }

    public static function clearCache(): void
    {
        Cache::forget('delivery.active_company');
        Cache::forget('delivery.wilayas');
    }
}
