<?php

namespace Tests\Unit;

use App\Actions\InsertionAction;
use App\Models\Brand;
use App\Http\Resources\BrandResource;
use Error;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsertionActionTest extends TestCase
{
    use RefreshDatabase;

    private string $model = Brand::class;
    private array $brand;
    private string $resource = BrandResource::class;

    public function test_it_inserts_a_brand(): void
    {
        $this->setBrand();

        $this->assertInserted();
    }

    public function test_it_returns_http_code_conflict_if_brand_already_exists(): void
    {
        $this->brand = ['name' => $this->getName()];

        $this->assertEquals($this->insert()->getStatusCode(), 409);
    }

    private function setBrand(): void {
        $this->brand = Brand::factory()->make()->toArray();
    }

    private function getName(): string {
        return Brand::first()->name;
    }

    private function insert(): mixed
    {
        return (new InsertionAction)->insert(
            data: $this->brand,
            model: Brand::class,
            resource: BrandResource::class
        );
    }

    private function assertInserted(): void
    {
        $this->assertDatabaseHas(
            'brands',
            ['name' => $this->brand['name']]
        );
    }
}
