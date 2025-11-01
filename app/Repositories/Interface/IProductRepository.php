<?php 
namespace App\Repositories\Interface;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\StoreProductResource;
use App\Http\Resources\UpdateProductResource;

interface IProductRepository{

    function createProduct(Request $request);
   // function createProduct(array $request);

    function GetAllProduct();
    function store(StoreProductRequest $request);
    function update(UpdateProductRequest $request, string $id);
    function destroy(string $id);
    function getProductById($id);
}