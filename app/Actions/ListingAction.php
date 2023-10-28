<?php

namespace App\Actions;

use Illuminate\Http\Resources\Json\JsonResource;

class ListingAction {
    private string $model;
    private string $orderByColumn;
    private string $orderByDirection;
    private ?string $whereColumn;
    private ?string $whereValue;

    public function list(string $model, string $resource, ?string $whereColumn = null, ?string $whereValue = null): JsonResource
    {
        $this->model = $model;
        $this->whereColumn = $whereColumn;
        $this->whereValue = $whereValue;

        return new $resource(
            $this->getList()
        );
    }

    private function getList()
    {
        if (is_null($this->whereColumn) === false) {
            return $this->model::where($this->whereColumn, "like", "%" . $this->whereValue . "%")
                ->get();
        }

        return $this->model::get();
    }
}
