<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
class DeleteProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command delete products with less than 10 quantity every monday midnight';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deletedCount = Product::where('stock', '<', 10)->delete();
        ("Deleted {$deletedCount} products with low quantity.");
    }
}
