<?php

namespace App\Actions;

use Illuminate\Http\Resources\Json\JsonResource;

class RemovalAction
{
    public function delete(string $id, string $model, string $resource): void {
        new $resource(
            tap($model::findOrFail($id))->delete()
        );
    }
}
