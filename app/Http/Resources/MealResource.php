<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $diffTime = $request->input('diff_time');
        
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $diffTime ? $this->getStatusBasedOnDiffTime($diffTime) : $this->status,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients')),
            'tags' => TagResource::collection($this->whenLoaded('tags'))
        ];
    }
}
