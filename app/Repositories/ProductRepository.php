<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Product;
use GuzzleHttp\Psr7\Response;
use   App\Repositories\Interface\IProductRepository;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\StoreProductResource;
use App\Http\Resources\UpdateProductResource;
class ProductRepository implements IProductRepository{

// public function createProduct(array $data)
// {
//     $product = Product::create([
//         'name' => $data['name'],
//         'category_id' => $data['category_id'],
//         'price' => $data['price'],
//     ]);

//     return response()->json($product);
// }


public function createProduct(Request $request)
    {
        $product = Product::Create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'price'=>$request->input('price'),
        ]);

        return response()->json($product);

        
    }


public function GetAllProduct(){
    return Product::get();

}

public function store(StoreProductRequest $request)
{
        $product = Product::Create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
        ]);
        return new StoreProductResource($product);
 }


     public function update(UpdateProductRequest $request, string $id)
     {

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'this product not found']);
        } else {
            $product->update([
                'name' => $request->input('name'),
                'price'=>$request->input('price'),
            ]);
            return new UpdateProductResource($product);
        }
     }



  public function destroy(string $id)
    {
        //delete
        $product = Product::find($id);
        $product->delete();
        return response()->json(['message' => 'deleted successfly']);
    }



  public function getProductById($id)
    {

        $product = Product::find($id);
        return response()->json($product);
    }



}