<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\DataTransferObjects\Product\StoreProductDTO;
use App\Http\DataTransferObjects\Product\UpdateProductDTO;
use App\Http\Requests\Api\V1\Product\StoreProductRequest;
use App\Http\Requests\Api\V1\Product\UpdateProductRequest;
use App\Http\Resources\Api\V1\Product\ProductCollection;
use App\Http\Resources\Api\V1\Product\ProductShowResource;
use App\Http\Resources\Api\V1\Product\ProductStoreResource;
use App\Http\Resources\Api\V1\Product\ProductUpdateResource;
use App\Http\Services\Interfaces\ProductServiceInterface;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index(): ProductCollection
    {
        return ProductCollection::make(
            $this->productService->index()
        );
    }

    public function store(StoreProductRequest $request): ProductStoreResource|JsonResponse
    {
        $createdProduct = $this->productService->store(
            StoreProductDTO::fromRequest($request)
        );

        return $createdProduct
            ? ProductStoreResource::make($createdProduct)->response()->setStatusCode(201)
            : Response::json('Product was not created', 500);
    }

    public function show(Product $product): ProductShowResource
    {
        return ProductShowResource::make($product);
    }

    public function update(UpdateProductRequest $request, Product $product): ProductUpdateResource|JsonResponse
    {
        $updatedProduct = $this->productService->update(
            $product,
            UpdateProductDTO::fromRequest($request)
        );

        return $updatedProduct
            ? ProductUpdateResource::make($updatedProduct)
            : Response::json('Update failed', 500);
    }

    public function destroy(Product $product): ProductShowResource|JsonResponse
    {
        $isDeleted = $this->productService->destroy($product);

        return $isDeleted
            ? ProductShowResource::make($isDeleted)
            : Response::json('Delete failed', 500);
    }
}
