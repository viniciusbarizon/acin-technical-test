<?php

namespace Tests\Unit;

use App\Actions\ReaderAction;
use App\Models\Brand;
use App\Http\Resources\BrandResource;
use Error;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class ReaderActionTest extends TestCase
{
    private Brand $brand;
    private BrandResource $brandRead;

    public function test_it_reads(): void {
        $this->setBrand();
        $this->setId();

        $this->read();

        $this->assertReader();
    }

    public function test_id_returns_model_not_found_exception_if_does_not_exist(): void {
        $this->expectException(ModelNotFoundException::class);

        $this->id = 999999;

        $this->read();
    }

    private function setBrand(): void {
        $this->brand = Brand::inRandomOrder()->first();
    }

    private function setId(): void {
        $this->id = $this->brand->id;
    }

    private function read(): void {
        $this->brandRead = (new ReaderAction)->execute(
            id: $this->id,
            model: Brand::class,
            resource: BrandResource::class
        );
    }

    private function assertReader(): void {
        $this->assertEquals($this->brand->id, $this->brandRead->id);
    }
}
