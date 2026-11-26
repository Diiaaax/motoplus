<?php

namespace App\Services;

use App\Models\FinancingOption;
use Illuminate\Support\Facades\Cache;

class FinancingService
{
    public function getAvailableOptions()
    {
        return Cache::remember('financing.options', 86400, function () {
            return FinancingOption::where('is_active', true)->get();
        });
    }

    public function calculateMonthlyPayment(
        float $price,
        float $downPaymentPercent,
        float $annualRate,
        int $months
    ): array {
        $downPayment = $price * ($downPaymentPercent / 100);
        $principal = $price - $downPayment;
        $monthlyRate = ($annualRate / 100) / 12;

        if ($monthlyRate == 0) {
            $monthlyPayment = $principal / $months;
        } else {
            $factor = pow(1 + $monthlyRate, $months);
            $monthlyPayment = $principal * ($monthlyRate * $factor) / ($factor - 1);
        }

        $totalPaid = $monthlyPayment * $months;
        $totalInterest = $totalPaid - $principal;

        return [
            'down_payment_percent' => $downPaymentPercent,
            'down_payment' => round($downPayment, 2),
            'principal' => round($principal, 2),
            'annual_rate' => $annualRate,
            'months' => $months,
            'monthly_payment' => round($monthlyPayment, 2),
            'total_interest' => round($totalInterest, 2),
            'total_paid' => round($totalPaid + $downPayment, 2),
        ];
    }

    public function estimate(float $price): array
    {
        $options = $this->getAvailableOptions();
        $estimates = [];

        foreach ($options as $option) {
            $estimates[] = $this->calculateMonthlyPayment(
                $price,
                $option->min_down_payment_percent,
                $option->interest_rate,
                $option->max_months
            );
        }

        return $estimates;
    }

    public static function clearCache(): void
    {
        Cache::forget('financing.options');
    }
}
