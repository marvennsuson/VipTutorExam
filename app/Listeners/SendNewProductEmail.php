<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewProductEmail;
use App\Events\ProductSendEmail;
use Illuminate\Support\Facades\Log;
class SendNewProductEmail  implements ShouldQueue
{
    public function handle(ProductSendEmail $event)
    {
        $product = $event->product;

        if ($product) { // Or if ($product !== null)
            try {
                Mail::to('admin@example.com')->send(new NewProductEmail($product));
                Log::info("Email sent for product: " . $product->id);
            } catch (\Exception $e) {
                Log::error("Error sending email: " . $e->getMessage());
            }
        } else {
            Log::error("Product not found for email sending. Product ID: " . $event->product->id ?? 'Unknown'); // Log the ID or 'Unknown' if unavailable
        }
    }
}
