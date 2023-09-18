<?php

use App\Models\Commande;
use App\Models\ProduitSuccursale;
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
        Schema::create('ligne_commandes', function (Blueprint $table) {
            $table->id();
            $table->integer("prix");
            $table->integer("quantite");
            $table->integer("reduction")->default(0);
            $table->foreignIdFor(Commande::class)->constrained();
            $table->foreignIdFor(ProduitSuccursale::class)->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_commandes');
    }
};
