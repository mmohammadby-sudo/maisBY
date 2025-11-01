<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\UpdateProductResource;
use App\Services\ProductService;
use OpenApi\Attributes as OA;

use function PHPSTORM_META\type;

class ProductController extends Controller
{
   private $productService;

   public function __construct(ProductService $productService) {
    $this->productService = $productService;
   }

    /**
     * Show the form for creating a new resource.
     */
    public function createProduct(Request $request)
    {

        return $this->productService->createProduct($request);
       
    }

#[OA\Get(
    path:'/getAllProduct',
    tags:['Products'],
    responses:[
        new  OA\Response(
            response:200,
            description:'Get All Products',

        )
        ]
        )]
    public function getAllProduct()
    {

        return  $this->productService->getAllProduct();
    }



 
#[OA\Get(
    path:'/getProductById/{id}',
    tags:['Products'],
     parameters: [
        new OA\Parameter(
            name: 'id',
            in: 'path',
            required: true,
            description: 'ID of the product to fetch',
            schema: new OA\Schema(type: 'integer'),
            example: 3
        )
    ],
    responses:[
        new  OA\Response(
            response:200,
            description:'Get Product By Id',

        )
        ])]
    public function getProductById($id)
    {
        return  $this->productService->getProductById($id);

    }




    /**
     * Store a newly created resource in storage.
     */
     #[OA\Post(
        path: '/store',
        summary: 'Create a product by ID',
        tags: ['Products'],
        requestBody: new OA\RequestBody(
            required:true,
            content:new OA\JsonContent(
                type:'object',
                properties:[
                   new OA\Property(property:'name',type:'string'),
                   new OA\Property(property:'price',type:'number'),
                   new OA\Property(property:'category_id',type:'integer'),
                ]

            )
                ),
        parameters: [
  new OA\Parameter(    name: "X-CSRF-TOKEN",
    in: "header",
    required: true,
    schema: new OA\Schema(type: "string"),
    example: "your-csrf-token-here",
    description: "CSRF token required for store requests"
    )],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Created successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Product Created successfully')
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Product not found')
        ]
    )]
    public function store(StoreProductRequest $request)
    {
        return  $this->productService->store($request);
    }

    
 

    /**
     * Update the specified resource in storage.
     */
     #[OA\Put(
        path: '/update/{id}',
        summary: 'Update a product by ID',
        tags: ['Products'],
         requestBody: new OA\RequestBody(
            required:true,
            content:new OA\JsonContent(
                type:'object',
                properties:[
                   new OA\Property(property:'name',type:'string'),
                   new OA\Property(property:'price',type:'number'),
                   new OA\Property(property:'category_id',type:'integer'),
                ]

            )
                ),
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer'),
                example: 6
            ),
  new OA\Parameter(    name: "X-CSRF-TOKEN",
    in: "header",
    required: true,
    schema: new OA\Schema(type: "string"),
    example: "your-csrf-token-here",
    description: "CSRF token required for Update requests"
    )],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Updated successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Product Updated successfully')
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Product not found')
        ]
    )]
    public function update(UpdateProductRequest $request, string $id)
    {
                return  $this->productService->update($request, $id);

    }

    /**
     * Remove the specified resource from storage.
     */
     #[OA\Delete(
        path: '/delete/{id}',
        summary: 'Delete a product by ID',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer'),
                example: 6
            ),
  new OA\Parameter(    name: "X-CSRF-TOKEN",
    in: "header",
    required: true,
    schema: new OA\Schema(type: "string"),
    example: "your-csrf-token-here",
    description: "CSRF token required for DELETE requests"
    )],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Deleted successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Product deleted successfully')
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Product not found')
        ]
    )]
    public function destroy(string $id)
    {
        //delete
        $product = Product::find($id);
        $product->delete();
        return response()->json(['message' => 'deleted successfly']);
    }



 
#[OA\Get(
    path: '/csrf-token',
    summary: 'Get CSRF token',
    tags: ['Auth'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Returns CSRF token',
            content: new OA\JsonContent(
                type: 'object'
            )
        )
    ]
)]
public function getCsrfToken()
{
    return response()->json(['csrf_token' => csrf_token()]);
}


}
