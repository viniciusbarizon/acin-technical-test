<?php

namespace App\Actions;

use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

class EditionAction
{
    private array $data;
    private string $id;

    public function edit(array $data, string $id, string $model, string $resource): mixed
    {
        $this->data = $data;
        $this->id = $id;
        $this->model = $model;

        try {
            return new $resource(
                $this->update()
            );
        }
        catch (QueryException) {
            return $this->getConflictResponse();
        }
    }

    private function update(): void {
        tap($this->model::findOrFail($this->id))
            ->update($this->data);
    }

    private function getConflictResponse(): Response {
        return response('Please, do not use values used by other records', 409);
    }
}
