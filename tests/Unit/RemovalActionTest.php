<?php

namespace Tests\Unit;

use App\Actions\RemovalAction;
use App\Http\Resources\RemovalResource;
use App\Models\Brand;
use Error;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RemovalActionTest extends TestCase
{
    use RefreshDatabase;

    private string $model = Brand::class;
    private BrandResource $resource;

    public function test_it_deletes_a_brand(): void {
        $this->remove();

        $this->assertResource();
        $this->assertMissing();
    }

    public function test_it_returns_model_not_found_exception_if_brand_does_not_exist(): void {
        $this->expectException(ModelNotFoundException::class);

        $this->id = 999999;

        $this->remove();
    }

    private function getRandomId(): string {
        return Brand::inRandomOrder()->first()->id;
    }

    private function remove(): void {
        $this->resource = (new RemovalAction)->delete(
            id: $this->getRandomId(),
            model: $this->model,
            resource: $this->resource
        );
    }

    private function assertResource(): void {
        $this->assertEquals(
            $this->resource,
            get_class($this->resource)
        );
    }

    private function assertMissing(): void {
        $this->assertDatabaseMissing('brands', [
            'id' => $this->id,
            'deleted_at' => null
        ]);
    }
}
