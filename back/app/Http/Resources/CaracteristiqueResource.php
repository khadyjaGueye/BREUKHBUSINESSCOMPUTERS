<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaracteristiqueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "libelle"=>$this->valeur,
            "valeur"=>$this->pivot->valeur,
            "description"=>$this->pivot->description,

        ];
    }
}
