<?php

namespace App\Actions;

use Illuminate\Http\Resources\Json\JsonResource;

class ListingAction {
    private string $model;
    private string $orderByColumn;
    private string $orderByDirection;

    public function list(string $model, string $orderByColumn, string $orderByDirection, string $resource): JsonResource
    {
        $this->model = $model;
        $this->orderByColumn = $orderByColumn;
        $this->orderByDirection = $orderByDirection;

        return new $resource(
            $this->getList()
        );
    }

    private function getList()
    {
        return $this->model::orderBy($this->orderByColumn, $this->orderByDirection)
            ->get();
    }
}
