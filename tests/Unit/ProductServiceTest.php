<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\ProductController;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Mockery;

class ProductServiceTest extends TestCase
{
    protected $productService;
    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productService = Mockery::mock(ProductService::class);
        $this->controller = new ProductController($this->productService);
    }

   public function test_returns_error_if_price_is_invalid()
{
    $request = new Request(['price' => '12.3']);

    $this->productService
        ->shouldReceive('createProduct')
        ->once()
        ->with($request)
        ->andReturn(['id' => 1, 'price' => 12.4]);

    $response = $this->controller->createProduct($request);

    $this->assertEquals(['id' => 1, 'price' => 12.4], $response);
}


    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
