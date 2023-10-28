<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class ListingAction {
    private string $model;
    private string $orderByColumn;
    private string $orderByDirection;
    private ?int $paginate;
    private ?string $whereColumn;
    private ?string $whereValue;

    public function list(
        string $model,
        ?int $paginate = null,
        string $resource,
        ?string $whereColumn = null,
        ?string $whereValue = null
    ): JsonResource
    {
        $this->model = $model;
        $this->paginate = $paginate;
        $this->whereColumn = $whereColumn;
        $this->whereValue = $whereValue;

        return new $resource(
            $this->getList()
        );
    }

    private function getList(): Collection|LengthAwarePaginator
    {
        $result = $this->model::withTrashed();

        if (is_string($this->whereColumn) && is_null($this->whereValue) === false) {
            $result = $result->where($this->whereColumn, "like", "%" . $this->whereValue . "%");
        }

        if (is_int($this->paginate)) {
            return $result->paginate($this->paginate);
        }

        return $result->get();
    }
}
