<?php

namespace App\Http\Controllers;

use App\Actions\ListingAction;
use App\Actions\ReadingAction;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    const MODEL = Brand::class;
    const RESOURCE = BrandResource::class;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        (new ReadingAction)->list(
            model: self::MODEL,
            resource: self::RESOURCE
        );
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
        return json_encode(
            (new ReadingAction)->read(
                id: $id,
                model: self::MODEL,
                resource: BrandResource::class
            )
        );
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
