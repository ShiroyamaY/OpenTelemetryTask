<?php

namespace App\Http\Services;

use App\Http\DataTransferObjects\Product\StoreProductDTO;
use App\Http\DataTransferObjects\Product\UpdateProductDTO;
use App\Http\Services\Interfaces\ProductServiceInterface;
use App\Models\Product;
use Illuminate\Pagination\AbstractPaginator;

class ProductService implements ProductServiceInterface
{
    public function index(): AbstractPaginator
    {
        return Product::query()->paginate(10);
    }

    public function store(StoreProductDTO $storeProductDTO): ?Product
    {
        $product = new Product([
            'name' => $storeProductDTO->name,
            'description' => $storeProductDTO->description,
            'price' => $storeProductDTO->price,
        ]);

        return $product->save() ? $product : null;
    }

    public function update(Product $product, UpdateProductDTO $updateProductDTO): ?Product
    {
        $updatedData = collect([
            'name' => $updateProductDTO->name,
            'description' => $updateProductDTO->description,
            'price' => $updateProductDTO->price,
        ])->filter()->toArray();

        if (!$updatedData) {
            return $product;
        }

        return $product->update($updatedData) ? $product : null;
    }

    public function destroy(Product $product): ?Product
    {
        $result = $product->delete();

        return $result ? $product : null;
    }
}
