<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentaireResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // app/Http/Resources/CommentaireResource.php

    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'billet_id'   => $this->billet_id,
            'COM_CONTENU' => $this->COM_CONTENU,
            'COM_DATE'    => $this->COM_DATE,
            // on suppose que la Resource UserResource gère correctement le user
            'user'       => new UserResource($this->user),
        ];
    }


}
