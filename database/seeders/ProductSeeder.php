<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as faker;
use App\Models\User;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        $user = User::all();
        foreach($user as $row){
            for($i = 1; $i <= 5 ;$i++){
                Product::create([
                        'user_id' => $row->id,
                        'title' =>  $faker->name,
                        'description' => $faker->text,
                        'stock' => $faker->randomNumber(1),
                        'price' => $faker->randomNumber(2)
                    ]);
                }
        }
    
    }
}
