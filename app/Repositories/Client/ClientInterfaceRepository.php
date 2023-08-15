<?php

namespace App\Repositories\Client;

use Illuminate\Support\Collection;

interface ClientInterfaceRepository
{
    public function list(?string $clientName = null): Collection;
}
