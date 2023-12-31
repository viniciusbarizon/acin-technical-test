<?php

namespace Tests\Unit;

use App\Actions\ReadingAction;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class ReadingActionTest extends TestCase
{
    private Brand $brand;

    private BrandResource $brandRead;

    public function test_it_reads(): void
    {
        $this->setBrand();
        $this->setId();

        $this->read();

        $this->assertReader();
    }

    public function test_id_returns_model_not_found_exception_if_does_not_exist(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $this->id = 999999;

        $this->read();
    }

    private function setBrand(): void
    {
        $this->brand = Brand::inRandomOrder()->first();
    }

    private function setId(): void
    {
        $this->id = $this->brand->id;
    }

    private function read(): void
    {
        $this->brandRead = (new ReadingAction)->read(
            id: $this->id,
            model: Brand::class,
            resource: BrandResource::class
        );
    }

    private function assertReader(): void
    {
        $this->assertTrue(
            $this->brand->is($this->brandRead)
        );
    }
}
