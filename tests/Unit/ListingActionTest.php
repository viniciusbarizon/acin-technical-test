<?php

namespace Tests\Unit;

use App\Actions\ListingAction;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Error;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Tests\TestCase;

class ListingActionTest extends TestCase
{
    private Collection $brands;
    private BrandResource $list;

    public function test_it_lists(): void
    {
        $this->setBrands();
        $this->list();

        $this->assertCollection();
    }

    private function setBrands(): void
    {
        $this->brands = Brand::all();
    }

    private function list(): void
    {
        $this->list = (new ListingAction)->list(
            model: Brand::class,
            resource: BrandResource::class
        );
    }

    private function assertCollection(): void
    {
        foreach ($this->brands as $brand) {
            $this->assertTrue($this->list->contains($brand));
        }
    }
}
