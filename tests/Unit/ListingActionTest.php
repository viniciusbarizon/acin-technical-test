<?php

namespace Tests\Unit;

use App\Actions\ListingAction;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Error;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Tests\TestCase;

class ListingActionTest extends TestCase
{
    private string $orderByColumn = 'name';
    private string $orderByDirection = 'asc';
    private BrandResource $list;

    public function test_it_lists(): void {
        $this->list();

        $this->assertCollection();
    }

    public function test_it_returns_query_exception_if_order_by_column_not_exist(): void {
        $this->expectException(QueryException::class);

        $this->orderByColumn = 'not_exist';

        $this->actionExecute();
    }

    private function list(): BrandCollection {
        $this->list = (new ListingAction)->list(
            collection: BrandCollection::class,
            model: Brand::class,
            orderByColumn: $this->orderByColumn,
            orderByDirection: $this->orderByDirection
        );
    }

    private function getResourceCollection(): BrandResource {
        return BrandResource::collection(
            Brand::all()
        );
    }

    private function assertCollection(): void {
        $this->assertTrue(
            $this->list->is($this->getResourceCollection())
        );
    }
}
