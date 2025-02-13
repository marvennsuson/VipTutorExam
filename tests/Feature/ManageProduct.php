<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
class ManageProduct extends TestCase
{
    use RefreshDatabase; 

    public function test_can_create_a_product()
    {
        $data = [
            'title' => 'Test Product',
            'description' => 'A test product description',
            'price' => 19.99,
            'stock' => 2,
        ];

        $response = $this->postJson(route('user.product.store'), $data); 
        $response->assertStatus(201)->assertJsonFragment($data); 
        $this->assertDatabaseHas('products', $data); 
    }

    public function test_can_read_a_product()
    {
        $product = Product::factory()->create(); 

        $response = $this->getJson(route('user.product.show', $product)); 

        $response->assertStatus(200)
            ->assertJsonFragment($product->toArray()); 
    }

    public function test_can_update_a_product()
    {
        $product = Product::factory()->create();

        $updatedData = [
            'name' => 'new Cat',
            'price' => 29.99,
            'stock' => 12,
        ];

        $response = $this->putJson(route('user.product.update', $product), $updatedData); 

        $response->assertStatus(200)->assertJsonFragment($updatedData);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'new Cat',
            'price' => 29.99,
            'stock' => 12,
        ]); 
    }

    public function test_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson(route('user.product.destroy', $product)); 

        $response->assertStatus(204); 

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_can_list_all_products()
    {
        Product::factory(3)->create();

        $response = $this->getJson(route('user.product.index')); 

        $response->assertStatus(200); 
        $response->assertJsonStructure([
            '*' => [ 
                'id',
                'title',
                'description',
                'price',
                'stock',
         
            ],
        ]);

    }

}
