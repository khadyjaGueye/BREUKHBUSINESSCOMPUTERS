<?php

use App\Models\Produit;
use App\Models\Caracteristique;
use App\Models\Unite;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carateristique_produit', function (Blueprint $table) {
            $table->id();
            $table->integer("valeur");
            $table->string("description");
            $table->foreignIdFor(Produit::class)->constrained();
            $table->foreignIdFor(Caracteristique::class)->constrained();
            //$table->foreignIdFor(Unite::class)->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit_carateristiques');
    }
};
