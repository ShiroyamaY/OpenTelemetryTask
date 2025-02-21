<?php

namespace App\Http\Services\Interfaces;

use App\Http\DataTransferObjects\Product\StoreProductDTO;
use App\Http\DataTransferObjects\Product\UpdateProductDTO;
use App\Models\Product;
use Illuminate\Pagination\AbstractPaginator;

interface ProductServiceInterface
{
    public function index(): AbstractPaginator;
    public function store(StoreProductDTO $storeProductDTO): ?Product;
    public function update(Product $product, UpdateProductDTO $updateProductDTO): ?Product;
    public function destroy(Product $product): ?Product;
}
