<?php

namespace Tests\Feature;

use App\Models\{Brand, Category, User, Product, Producer};
use Illuminate\Foundation\{Testing\RefreshDatabase, Testing\WithFaker};
use Tests\TestCase;


class DataBasesTest extends TestCase
{
    use RefreshDatabase;



    public function test_crud_users(): void
    {
        // create
        $user = User::factory()->create();

        $this->assertModelExists($user);

        $this->assertDatabaseCount('users', 26);
        //read
        $this->assertDatabaseHas("users", ['email' => $user->email, 'name' => $user->name]);
        // update
        $firstUser = User::first();

        $firstUser->name = "Asdf";

        $this->assertEquals("Asdf", $firstUser->name);
        //delete
        $user->delete();

        $this->assertModelMissing($user);
    }


    public function test_product_belongs_to_brand(): void
    {
        $brand = Brand::factory()->create();

        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $this->assertInstanceOf(Brand::class, $product->brand);
        $this->assertEquals($brand->id, $product->brand->id);
    }


    public function test_brand_has_many_poducts(): void
    {
        $brand = Brand::factory()->create();
        Product::factory()->create(['brand_id' => $brand->id]);

        $this->assertInstanceOf(Product::class, $brand->products()->first());
    }


    public function test_product_category_many_to_many_relationship(): void
    {

        $category = Category::factory(3)->create();
        $product = Product::factory()->hasAttached($category)->create();


        $this->assertInstanceOf(Category::class, $product->first()->categories()->first());
        $this->assertEquals($category->first()->id, $product->categories()->first()->id);

        $this->assertInstanceOf(Product::class, $category->first()->products()->first());
    }

    public function test_product_producer_one_to_many(): void
    {
        $producer = Producer::factory()->create();
        $product = Product::factory()->create(['producer_id' => $producer->id]);

        $this->assertInstanceOf(Producer::class, $product->producer);
        $this->assertEquals($producer->id, $product->producer->id);

        $this->assertInstanceOf(Product::class, $producer->product()->first());
    }
}
