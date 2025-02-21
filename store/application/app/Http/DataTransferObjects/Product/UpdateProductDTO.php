<?php

namespace App\Http\DataTransferObjects\Product;

use App\Http\Requests\Api\V1\Product\UpdateProductRequest;

class UpdateProductDTO
{
    private function __construct(
        public ?string $name,
        public ?string $description,
        public ?string $price,
    )
    {}

    public static function fromRequest(
        UpdateProductRequest $request
    ): UpdateProductDTO
    {
        return new UpdateProductDTO(
            $request->validated('name'),
            $request->validated('description'),
            $request->validated('price')
        );
    }
}
