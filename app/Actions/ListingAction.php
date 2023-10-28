<?php

namespace App\Actions;

use Illuminate\Http\Resources\Json\JsonResource;

class ListingAction {
    private string $model;
    private string $orderByColumn;
    private string $orderByDirection;

    public function list(string $model, string $resource): JsonResource
    {
        $this->model = $model;

        return new $resource(
            $this->getList()
        );
    }

    private function getList()
    {
        return $this->model::get();
    }
}
