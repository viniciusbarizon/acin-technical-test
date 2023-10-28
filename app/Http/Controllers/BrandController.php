<?php

namespace App\Http\Controllers;

use App\Actions\EditionAction;
use App\Actions\InsertionAction;
use App\Actions\ListingAction;
use App\Actions\ReadingAction;
use App\Actions\RemovalAction;
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
        return json_encode(
            (new ListingAction)->list(
                model: (new Brand),
                paginate: request()->paginate,
                resource: self::RESOURCE,
                whereColumn: request()->whereColumn,
                whereValue: request()->whereValue
            )
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
                resource: self::RESOURCE
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return json_encode(
            (new EditionAction)->edit(
                data: $request->post(),
                id: $id,
                model: self::MODEL,
                resource: self::RESOURCE
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return json_encode(
            (new RemovalAction)->remove(
                id: $id,
                model: self::MODEL,
                resource: self::RESOURCE
            )
        );
    }
}
