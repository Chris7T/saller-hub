<?php

namespace App\Actions\Client;

use App\Repositories\Client\ClientInterfaceRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ClientListAction
{
    public function __construct(
        private readonly ClientInterfaceRepository $clientInterfaceRepository
    ) {
    }

    public function execute(?string $clientName = null): Collection
    {
        $clientNameLower = null;
        if(!is_null($clientName)) {
            $clientNameLower = strtolower($clientName);
            $cacheKey = "client_list_{$clientNameLower}";
        }
        $cacheKey = 'client_list';

        return Cache::remember(
            $cacheKey,
            config('cache.time.one_hour'),
            function () use ($clientName) {
                return $this->clientInterfaceRepository->list($clientName);
            }
        );
    }
}
