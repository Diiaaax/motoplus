<?php

namespace App\DTOs;

use App\Models\Product;
use Illuminate\Support\Collection;

class ComparisonDTO
{
    public function __construct(
        public readonly array $products,
        public readonly Collection $specificationGroups,
    ) {}

    public static function fromProducts(array $products): self
    {
        $specGroups = collect();
        foreach ($products as $product) {
            foreach ($product->specifications as $spec) {
                if (!$specGroups->has($spec->group)) {
                    $specGroups->put($spec->group, collect());
                }
                if (!$specGroups->get($spec->group)->pluck('label')->contains($spec->label)) {
                    $specGroups->get($spec->group)->push(['label' => $spec->label]);
                }
            }
        }

        return new self(
            products: $products,
            specificationGroups: $specGroups,
        );
    }

    public function getValue(Product $product, string $group, string $label): ?string
    {
        $spec = $product->specifications
            ->where('group', $group)
            ->where('label', $label)
            ->first();

        return $spec?->value;
    }
}
