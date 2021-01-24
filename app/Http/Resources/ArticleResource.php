<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'id' => $this->id,
            'views' => $this->views,
            'likes' => $this->likes,
            'slug' => $this->slug,
            'text' => $this->text,
            'image' => 'https://via.placeholder.com/150.png',
            'comments' => $this->comments
        ];
    }
}
