<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentaireRequest;
use App\Http\Requests\UpdateCommentaireRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Commentaire;

use App\Http\Resources\CommentaireResource;
// …


class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCommentaireRequest $request)
    {
        // Récupère l’utilisateur authentifié
        $user = $request->user();

        // 1) création du commentaire en injectant user_id
        $comment = Commentaire::create(array_merge(
            $request->validated(),
            ['user_id' => $user->id]
        ));

        // 2) on recharge la relation 'user' pour l’API
        $comment->load('user');

        // 3) on renvoie via la Resource, qui inclut le user
        return (new CommentaireResource($comment))
                    ->response()
                    ->setStatusCode(201);
    }




    /**
     * Display the specified resource.
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentaireRequest $request, Commentaire $commentaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commentaire $commentaire)
    {
        //
    }
}
