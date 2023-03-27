<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
            [
                'id' => $this->id,
                'title' => $this->title,
                'decsription' => $this->description,
                'user' => new UserResource($this->user)
            ];
    }
}
