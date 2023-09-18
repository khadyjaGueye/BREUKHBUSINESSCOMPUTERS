<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\returnSelf;

class UserControlle extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return response()->json([
            "status" => 200,
            "users" => UserResource::collection($user)
        ]);
    }
    public function logout($id)
    {
        $user = User::find($id);
        Auth::logout($user);
        return response()->json([
            'status' => 'success',
            'message' => 'Deconnection reuisie  '
        ]);
    }
    public function loginUser(Request $request)
    {
        try {
            $validateUser = validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error: ',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'email ou password incorrect'
                ], 401);
            }
            $user = User::where('email', $request->email)->first();
            //$user = Auth::user(); c'est une autre facon de recupere l'utilisateur
            // $token = $user->createToken("API Token")->plainTextToken;
            // $cookie = cookie("token",$token,24*60);

            return response()->json([
                'status' => true,
                'message' => 'User login successful',
                'token' => $user->createToken("API Token")->plainTextToken,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function user(Request $request){
        return $request->user();
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
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            "name" => $request->name,
            "adresse" => $request->adresse,
            "login" => $request->login,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "succursale_id" => $request->succursale_id,
            "role" => $request->role,
        ]);
        return response()->json([
            "status" => 200,
            "message" => "Isertion resuisie",
            "user" => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::select('users.*')->where('id', $id)->first();
        return response()->json([
            "status" => 200,
            "user" => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->update([
            "name" => $request->name,
            "adresse" => $request->adresse,
            "login" => $request->login,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "succursale_id" => $request->succursale_id,
            "role" => $request->role,
        ]);
        return response()->json([
            "status" => 200,
            "Message" => "modification avec succès",
            "user" => $user
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(
            [
                'message' => 'Article supprimé avec succès',
                'status' => 200
            ]
        );
    }
}
