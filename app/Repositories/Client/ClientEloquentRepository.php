<?php

namespace App\Repositories\Client;

use App\Models\Client;
use Illuminate\Support\Collection;

class ClientEloquentRepository implements ClientInterfaceRepository
{
    public function __construct(
        private readonly Client $model,
    ) {
    }

    public function list(?string $clientName = null): Collection
    {
        return $this->model
            ->with(['contacts', 'sellers'])
            ->when($clientName, function ($query, $clientName) {
                return $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($clientName) . '%']);
            })
            ->get();
    }    
}
