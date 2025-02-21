<?php

namespace App\Http\DataTransferObjects\Product;

use App\Http\Requests\Api\V1\Product\StoreProductRequest;

class StoreProductDTO
{
    private function __construct(
        public string $name,
        public string $description,
        public string $price,
    )
    {}

    public static function fromRequest(
        StoreProductRequest $request
    ): StoreProductDTO
    {
        return new StoreProductDTO(
            $request->validated('name'),
            $request->validated('description'),
            $request->validated('price')
        );
    }
}
