<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

use App\Http\Controllers\{
    UserController,
    BilletController,
    CommentaireController
};
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Authenticated routes (protected by Sanctum)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'show']);

    Route::post('/user/logout', function (Request $request) {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Déconnexion réussie.'
        ]);
    });

    Route::get('/billets/{id}', [BilletController::class, 'show'])
        ->whereNumber('id');

        Route::post('/commentaires', [CommentaireController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| Register
|--------------------------------------------------------------------------
*/
Route::post('/register', [UserController::class, 'store']);

/*
|--------------------------------------------------------------------------
| Login (returns JSON token + user)
|--------------------------------------------------------------------------
*/
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email|max:50',
        'password' => 'required|string|min:8',
    ]);

    try {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'access_token' => $user->createToken('auth_token')->plainTextToken,
            'token_type' => 'Bearer',
            'data' => [
                'id' => $user->id,
                'nom' => $user->name,
                'email' => $user->email,
            ]
        ]);

    } catch (\Illuminate\Database\QueryException $e) {
        Log::error('Erreur accès base de données : ' . $e->getMessage());

        return response()->json([
            'message' => 'Ressource indisponible.'
        ], 500);
    }
});

/*
|--------------------------------------------------------------------------
| Public list of blog posts
|--------------------------------------------------------------------------
*/
Route::get('/billets', [BilletController::class, 'index']);
