<?php

use App\Models\Succursale;
use App\Models\Produit;
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
        Schema::create('produit_succursale', function (Blueprint $table) {
            $table->id();
            $table->integer("prix");
            $table->integer("prix_en_gros");
            $table->integer("quantite");
            $table->foreignIdFor(Succursale::class)->constrained();
            $table->foreignIdFor(Produit::class)->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit_succursales');
    }
};
