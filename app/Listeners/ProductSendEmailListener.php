<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewProductEmail;
use App\Events\ProductSendEmail;
use Illuminate\Support\Facades\Log;
class ProductSendEmailListener  implements ShouldQueue
{
    // /**
    //  * Create the event listener.
    //  */
    // public function __construct()
    // {
    //     //
    // }

    // /**
    //  * Handle the event.
    //  */
    public function handle(ProductSendEmail $event): void
    {
        $product = $event->product;

        if ($product) { 
            try {
                Mail::to('admin@example.com')->send(new  \App\Mail\NewProductEmail($product));
                Log::info("Email sent for product: " . $product->id);
            } catch (\Exception $e) {
                Log::error("Error sending email: " . $e->getMessage());
            }
        } else {
            Log::error("Product not found for email sending. Product ID: " . $event->product->id ?? 'Unknown'); // Log the ID or 'Unknown' if unavailable
        }
    }
}
