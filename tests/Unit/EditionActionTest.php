<?php

namespace Tests\Unit;

use App\Actions\EditionAction;
use App\Models\Brand;
use App\Http\Resources\BrandResource;
use Error;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditionActionTest extends TestCase
{
    use RefreshDatabase;

    private Brand $brand;
    private string $id;
    private string $name;
    private $response;

    public function test_it_updates(): void {
        $this->setBrand();
        $this->setId();
        $this->name = $this->getFakeName();

        $this->update();
        $this->freshModel();

        $this->assertNewName();
    }

    public function test_it_returns_model_not_found_exception_if_not_found(): void {
        $this->expectException(ModelNotFoundException::class);

        $this->id = 999999;
        $this->name = $this->getFakeName();

        $this->update();
    }

    public function test_it_returns_http_code_conflict_if_name_already_exists(): void {
        $this->setBrand();
        $this->setId();
        $this->name = $this->getNameAlreadyExists();

        $this->update();

        $this->assertEquals($this->response->getStatusCode(), 409);
    }

    private function setBrand(): void {
        $this->brand = Brand::inRandomOrder()->first();
    }

    private function setId(): void {
        $this->id = $this->brand->id;
    }

    private function getFakeName(): string {
        return fake()->company;
    }

    private function getNameAlreadyExists(): string {
        return Brand::where('id', '!=', $this->id)->first()->name;
    }

    private function update(): void {
        $this->response = (new EditionAction)->execute(
            data: ['name' => $this->name],
            id: $this->id,
            model: Brand::class,
            resource: BrandResource::class
        );
    }

    private function freshModel(): void {
        $this->brand->fresh();
    }

    private function assertNewName(): void {
        $this->assertEquals($this->name, $this->brand->name);
    }

}
