<?php

namespace App\Http\Controllers;

use App\Http\Resources\{BilletsResource,BilletResource};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use App\Models\Billet;

class BilletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $billets = Billet::with('commentaires.user')->get();
        return BilletResource::collection($billets);
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
    public function store(StoreBilletRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $billet = Billet::with('commentaires.user')->findOrFail($id);
        return new BilletResource($billet);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Billet $billet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBilletRequest $request, Billet $billet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Billet $billet)
    {
        //
    }
}
