<?php

namespace App\Actions;

use Illuminate\Http\Resources\Json\JsonResource;

class RemovalAction
{
    public function remove(string $id, string $model, string $resource): JsonResource
    {
        return new $resource(
            tap($model::findOrFail($id))->delete()
        );
    }
}
