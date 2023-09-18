<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];
    protected $hidden = [
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function succursales(){
        return $this->belongsToMany(Succursale::class,'produit_succursale')->withPivot(["quantite","prix","prix_en_gros"]);
    }

    public function carateristiques(){
        return $this->belongsToMany(Caracteristique::class)->withPivot(["valeur","description"]);
    }
}
