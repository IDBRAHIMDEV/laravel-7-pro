<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'code' => $this->id,
            'titre' => $this->title,
            'contenu' => $this->body,
            'mt' => $this->updated_at->diffForHumans(),
            'category' => $this->category->label
        ];
    }
}
