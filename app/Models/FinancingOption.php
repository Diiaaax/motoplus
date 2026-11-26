<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancingOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bank_name',
        'interest_rate',
        'max_months',
        'min_down_payment_percent',
        'description',
        'is_active',
    ];

    protected $casts = [
        'interest_rate' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}
