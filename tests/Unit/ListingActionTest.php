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
    private Brand $brand;
    private BrandResource $list;
    private ?int $paginate = null;
    private ?string $whereColumn = null;
    private ?string $whereValue = null;

    public function test_it_lists_all_brands(): void
    {
        $this->setBrands();
        $this->list();

        $this->assertNoFilter();
    }

    public function test_it_lists_with_filter(): void
    {
        $this->setBrand();
        $this->setWheres();

        $this->list();

        $this->assertFilter();
    }

    public function test_it_lists_with_pagination(): void
    {
        $this->setBrands();
        $this->paginate = 5;

        $this->list();

        $this->assertPagination();
    }

    private function setBrands(): void
    {
        $this->brands = Brand::all();
    }

    private function setBrand(): void
    {
        $this->brand = Brand::inRandomOrder()->first();
    }

    private function setWheres(): void
    {
        $this->whereColumn = "name";
        $this->whereValue = $this->brand->name;
    }

    private function list(): void
    {
        $this->list = (new ListingAction)->list(
            model: (new Brand),
            paginate: $this->paginate,
            resource: BrandResource::class,
            whereColumn: $this->whereColumn,
            whereValue: $this->whereValue
        );
    }

    private function assertNoFilter(): void
    {
        foreach ($this->brands as $brand) {
            $this->assertTrue(
                $this->list->contains($brand)
            );
        }
    }

    private function assertFilter(): void
    {
        $this->assertTrue(
            $this->list->contains($this->brand)
        );

        $this->assertEquals(
            1,
            $this->list->count()
        );
    }

    private function assertPagination(): void
    {
        $this->assertEquals(
            $this->paginate,
            $this->list->count()
        );
    }
}
