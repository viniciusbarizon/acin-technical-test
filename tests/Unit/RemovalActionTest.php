<?php

namespace Tests\Unit;

use App\Actions\RemovalAction;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Error;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RemovalActionTest extends TestCase
{
    use RefreshDatabase;

    private Brand $brand;
    private string $id;

    public function test_it_deletes_a_brand(): void
    {
        $this->setBrand();
        $this->setId();

        $this->remove();

        $this->assertDeleted();
    }

    public function test_it_returns_model_not_found_exception_if_brand_does_not_exist(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $this->id = 999999;

        $this->remove();
    }

    private function setBrand(): void
    {
        $this->brand = Brand::inRandomOrder()->first();
    }

    private function setId(): void
    {
        $this->id = $this->brand->id;
    }

    private function remove(): void
    {
        (new RemovalAction)->remove(
            id: $this->id,
            model: Brand::class,
            resource: BrandResource::class
        );
    }

    private function assertDeleted(): void
    {
        $this->assertSoftDeleted($this->brand);
    }
}
