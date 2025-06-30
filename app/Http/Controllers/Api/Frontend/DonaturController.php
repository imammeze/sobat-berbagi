<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donatur;
use Illuminate\Support\Facades\Storage;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Donatur::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
