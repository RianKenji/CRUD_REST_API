<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'comments_content' => $this->comments_content,
            'user_id' => $this->user_id,
            'commentator' => $this->whenLoaded('commentator'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
