<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use Faker\Factory as faker;
class ManageProductTest  extends TestCase
{
    // use RefreshDatabase; 

    public function test_can_create_a_product(): void
    {
        $data = [
            'id' => '42',
            'title' => 'Test Product',
            'description' => 'A test product description',
            'price' => '19.99',
            'stock' => '2',
        ];

        $response = $this->postJson(route('test.product.store'), $data); 
        $response->assertStatus(201)->assertJsonFragment($data); 
        $this->assertDatabaseHas('products', $data); 
    }

    public function test_can_read_a_product(): void
    {
        $faker = faker::create();
        $product =   Product::create([
            'user_id' => $faker->randomNumber(2),
            'title' =>  $faker->name,
            'description' => $faker->text,
            'stock' => $faker->randomNumber(1),
            'price' => $faker->randomNumber(2)
        ]);

        $response = $this->getJson(route('test.product.show', $product)); 

        $response->assertStatus(200)
            ->assertJsonFragment($product->toArray()); 
    }

    public function test_can_update_a_product(): void
    {
        $faker = faker::create();
        $product =   Product::create([
       
            'title' =>  $faker->name,
            'description' => $faker->text,
            'stock' => $faker->randomNumber(1),
            'price' => $faker->randomNumber(2)
        ]);

        $updatedData = [
            'title' => 'new Cat',
            'description' => 'this is my sample Update',
            'price' => 29.99,
            'stock' => 12,
        ];

        $response = $this->putJson(route('test.product.update', $product), $updatedData); 

        $response->assertStatus(200)->assertJsonFragment($updatedData);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'description' => 'this is my sample Update',
            'price' => 29.99,
            'stock' => 12,
        ]); 
    }

    public function test_can_delete_a_product(): void
    {
        $faker = faker::create();
        $product =   Product::create([
            'user_id' => $faker->randomNumber(2),
            'title' =>  $faker->name,
            'description' => $faker->text,
            'stock' => $faker->randomNumber(1),
            'price' => $faker->randomNumber(2)
        ]);

 
        $response = $this->deleteJson(route('test.product.destroy', $product)); 

        $response->assertStatus(204); 

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_can_list_all_products(): void
    {
        // Product::factory(3)->create();

        $response = $this->getJson(route('test.product.index')); 

        $response->assertStatus(200); 
        $response->assertJsonStructure([
            'data' => [
            '*' => [ 
                'id',
                'title',
                'description',
                'price',
                'stock',
         
            ],
        ],
        ]);

    }

}
