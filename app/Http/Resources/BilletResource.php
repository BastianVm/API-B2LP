<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BilletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id'    => $this->id,   // la vraie PK
            'date'         => $this->BIL_DATE,
            'title'        => $this->BIL_TITRE,
            'content'      => $this->BIL_CONTENU,
            'commentaires' => CommentaireResource::collection($this->commentaires),
        ];
    }


}
