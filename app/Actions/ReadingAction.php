<?php

namespace App\Actions;

use Illuminate\Http\Resources\Json\JsonResource;

class ReadingAction
{
    public function read(string $id, string $model, string $resource): JsonResource
    {
        return new $resource(
            $model::findOrFail($id)
        );
    }
}
