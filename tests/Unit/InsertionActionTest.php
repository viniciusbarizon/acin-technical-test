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

    private Brand $brand;
    private $response;

    public function test_it_inserts_a_brand(): void
    {
        $this->setBrand();

        $this->insert();

        $this->assertInserted();
    }

    public function test_it_returns_http_code_conflict_if_brand_already_exists(): void
    {
        $this->brand = Brand::first();

        $this->insert();

        $this->assertEquals($this->response->getStatusCode(), 409);
    }

    private function setBrand(): void
    {
        $this->brand = Brand::factory()->make();
    }

    private function insert(): void
    {
        $this->response = (new InsertionAction)->insert(
            data: $this->brand->toArray(),
            model: Brand::class,
            resource: BrandResource::class
        );
    }

    private function assertInserted(): void
    {
        $this->assertDatabaseHas('brands', ['name' => $this->brand->name]);
    }
}
