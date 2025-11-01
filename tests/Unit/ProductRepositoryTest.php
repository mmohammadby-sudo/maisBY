<?php
namespace Tests\Unit;
use Tests\TestCase;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductRepositoryTest extends TestCase
{
    ///use RefreshDatabase;
    protected $productRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productRepository = new ProductRepository();
    }

   /** @test create in DB */
    public function test_can_create_a_product()
    {
        $repository = new ProductRepository();

        $category = \App\Models\Category::factory()->create();

        $request = new Request([
            'name' => 'Coffee',
            'category_id' => $category->id,
            'price' => 12.99
        ]);

        $repository->createProduct($request);

        $this->assertDatabaseHas('products', [
            'name' => 'Coffee',
            'category_id' => $category->id,
            'price' => 12.99
        ]);
    }


     /** @test update in DB */
    public function test_can_update_a_product()
    {
        $repository = new ProductRepository();

        $category = \App\Models\Category::factory()->create();

          $product = Product::factory()->create([
            'name' => 'Old Name',
            'category_id' => $category->id,
            'price' => 10.00,
        ]);

           $updatedRequest = new UpdateProductRequest([
            'name' => 'tea',
            'category_id' => $category->id,
            'price' => 19.99
        ]);


        $repository->update($updatedRequest,$product->id);

        $this->assertDatabaseHas('products', [
            'name' => 'tea',
            'category_id' => $category->id,
            'price' => 19.99
        ]);
    }
}
