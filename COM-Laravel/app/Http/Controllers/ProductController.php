<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\StoreProductResource;
use App\Http\Resources\UpdateProductResource;


class ProductController extends Controller
{
   

    /**
     * Show the form for creating a new resource.
     */
    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'category_id' => 'required',
        ]);
        $product = Product::Create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
        ]);

        return response()->json($product);
        //
    }


    public function getAllProduct()
    {

        return Product::get();
    }




    public function getProductById($id)
    {

        $product = Product::find($id);

        return response()->json($product);
        //return Product::where('id', $request->input('id'))->first(); XXX
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::Create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
        ]);
        return new StoreProductResource($product);
        //return response()->json($product);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'this product not found']);
        } else {
            $product->update([
                'name' => $request->input('name')
            ]);
            //  return response()->json($product);
            return new UpdateProductResource($product);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete
        $product = Product::find($id);
        $product->delete();
        return response()->json(['message' => 'deleted successfly']);
    }
}
