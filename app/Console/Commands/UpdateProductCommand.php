<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
class UpdateProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that update quantity of products';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $product = Product::get();

       foreach($product as $row){
        $row->stock =  10;
        $row->save();
       }
       Log::info("update quanity products and set to 10.");
    }
}
