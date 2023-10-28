<?php

namespace App\Actions;

use Illuminate\Http\Resources\Json\JsonResource;

class ListingAction {
    private string $model;
    private string $orderByColumn;
    private string $orderByDirection;
    private ?array $wheres;

    public function list(string $model, string $resource, array $wheres = null): JsonResource
    {
        $this->model = $model;
        $this->wheres = $wheres;

        return new $resource(
            $this->getList()
        );
    }

    private function getList()
    {
        if (is_null($this->wheres) === false) {
            return $this->model::where($this->wheres)->get();
        }

        return $this->model::get();
    }
}
