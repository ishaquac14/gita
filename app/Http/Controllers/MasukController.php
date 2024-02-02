<?php

namespace App\Http\Controllers;

use App\Models\Masuk;
use App\Http\Requests\StoreMasukRequest;
use App\Http\Requests\UpdateMasukRequest;

class MasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masuks = Masuk::orderBy('created_at', 'desc')->get();
        return view('pages.masuk.index', compact('masuks'));
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
    public function store(StoreMasukRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Masuk $masuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Masuk $masuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMasukRequest $request, Masuk $masuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Masuk $masuk)
    {
        //
    }
}
