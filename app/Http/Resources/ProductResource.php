<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'user_id' => (int)  $this->user_id,
       
            'title' =>  $this->title,
            'description' =>  $this->description,
            'stock' =>  $this->stock,
            'price' =>  $this->price,
            'image' =>  $this->image,
            'fullpath' =>  $this->fullpath,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
