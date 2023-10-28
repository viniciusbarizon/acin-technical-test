<?php

namespace App\Actions;

use Illuminate\Database\QueryException;

class InsertionAction
{
    public function insert(array $data, string $model): mixed {
        try {
            return $model::create($data);
        }
        catch (QueryException) {
            return response('Please, do not use values used by other records', 403);
        }
    }
}
