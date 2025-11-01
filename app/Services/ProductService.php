<?php

namespace App\Services;

use App\Models\Product;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use App\Repositories\Interface\IProductRepository;
use Illuminate\Support\Facades\Validator;
 use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\StoreProductResource;
use App\Http\Resources\UpdateProductResource;

class ProductService{


    protected $ProductRepository;

    public function __construct(IProductRepository $IProductRepository) {
        $this->ProductRepository = $IProductRepository;
    }


public function createProduct(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|min:3',
        //     'category_id' => 'required',
        // ]);
 
        $validator=validator::make($request->all(),[//name validation in req
            'price' => 'required|decimal:2' 
        ]);
        

        if($validator->fails()){
            
             return Response()->json([
                'error'=>$validator->errors()]);
            
        }

     return $this->ProductRepository->createProduct($request);

    }

    public function GetAllProduct(){

        return $this->ProductRepository->GetAllProduct();
    } 

    public function store(StoreProductRequest $request)//sssame
{

     $validator=validator::make($request->all(),[
            'price' => 'required|decimal:2' 
        ]);
        

        if($validator->fails()){
            
             return Response()->json([
                'error'=>$validator->errors()]);
            
        }

  return $this->ProductRepository->store($request);

}



 public function update(UpdateProductRequest $request, string $id)
{
         $validator=validator::make($request->all(),[
            'price' => 'required|decimal:2' 
        ]);
        
  return $this->ProductRepository->update($request,$id);

}



  public function destroy(string $id)
    {
          return $this->ProductRepository->destroy($id);
    }



public function getProductById($id)
{
    return $this->ProductRepository->getProductById($id);

}
}
 