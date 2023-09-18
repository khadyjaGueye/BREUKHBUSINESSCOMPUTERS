<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Http\Resources\ProduitResource;
use App\Models\Caracteristique;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Catch_;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produts = Produit::all();
        return ProduitResource::collection($produts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduitRequest $request)
    {
        try {
            DB::beginTransaction();

            $produit = Produit::create([
                "libelle" => $request->libelle,
                "code" => $request->code,
                "photo" => $request->photo
            ]);

            foreach ($request->succursales as $succursale) {
                $produit->succursales()->attach($succursale['succursale_id'], [
                    'quantite' => $succursale['quantite'],
                    'prix' => $succursale['prix'],
                    'prix_en_gros' => $succursale['prix_en_gros']
                ]);
            }
            foreach ($request->caracteristiques as $caracteristique) {
                $produit->carateristiques()->attach($caracteristique['caracteristique_id'], [
                    'valeur' => $caracteristique['valeur'],
                    'description' => $caracteristique['description'],
                ]);
            }

            // $caract = Caracteristique::create([
            //     "valeur" => $request->valeur,
            //     "description" => $request->description,
            // ]);

            DB::commit();
            return response()->json(
                ["data"=> [
                    "produit"=>new ProduitResource($produit)
                ]]
              );
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }
    // public function store(StoreProduitRequest $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $produit = Produit::create([
    //             "libelle" => $request->libelle,
    //             "code" => $request->code,
    //             "photo"=>$request->photo
    //         ]);
    //         $produit->succursales()->attach($request->succursale_id,['quantite'=>$request->quantite, 'prix'=>12, 'prix_en_gros'=>$request->prix_en_gros]);

    //         $caract = Caracteristique::create([
    //             "valeur"=>$request->valeur,
    //             "description" => $request->description,
    //         ]);


    //         DB::commit();
    //         return response()->json(
    //             new ProduitResource($produit)
    //         );
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         return $th;
    //     }
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $code)
    {
        $produit = Produit::select('produits.*')->where('code', $code)->first();
       // return ProduitResource::make($produit);
       return response()->json(
        ["data"=> [
            "produit"=>new ProduitResource($produit)
        ]]
      );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduitRequest $request, Produit $produit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        //
    }
}
