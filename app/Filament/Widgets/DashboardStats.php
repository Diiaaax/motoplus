<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRevenue = Order::where('status', 'Delivered')->sum('total_price');
        $revenueDates = collect(range(0, 13))->map(fn($i) => now()->subDays(13 - $i)->format('Y-m-d'));
        $revenues = Order::where('status', 'Delivered')
            ->whereBetween('created_at', [now()->subDays(13)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as revenue')
            ->groupBy('date')
            ->pluck('revenue', 'date');
        $revenueChart = $revenueDates->map(fn($date) => (float)($revenues[$date] ?? 0))->toArray();

        $totalOrders = Order::count();
        $ordersByDate = Order::whereBetween('created_at', [now()->subDays(13)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');
        $ordersChart = $revenueDates->map(fn($date) => (int)($ordersByDate[$date] ?? 0))->toArray();

        $totalCustomers = Client::count();
        $clientsByDate = Client::whereBetween('created_at', [now()->subDays(13)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');
        $customersChart = $revenueDates->map(fn($date) => (int)($clientsByDate[$date] ?? 0))->toArray();

        $lowStock = Product::where('inventory', '<=', 5)->where('status', 'active')->count();

        return [
            Stat::make('Total Revenue', number_format($totalRevenue, 2) . ' DZD')
                ->description('Sum of all delivered orders')
                ->color('success')
                ->icon('heroicon-o-currency-dollar')
                ->chart($revenueChart),

            Stat::make('New Orders', $totalOrders)
                ->description('Total orders placed')
                ->color('primary')
                ->icon('heroicon-o-shopping-cart')
                ->chart($ordersChart),

            Stat::make('New Customers', $totalCustomers)
                ->description('Unique customers')
                ->color('info')
                ->icon('heroicon-o-user-group')
                ->chart($customersChart),

            Stat::make('Low Stock Alert', $lowStock)
                ->description('Products with ≤5 items remaining')
                ->color($lowStock > 0 ? 'danger' : 'success')
                ->icon('heroicon-o-exclamation-triangle'),
        ];
    }
}
