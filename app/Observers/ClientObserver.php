<?php

namespace App\Observers;

use App\Mail\ClientCreatedMail;
use App\Models\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class ClientObserver
{
    public function created(Client $client): void
    {
        Mail::to($client->email)->queue(new ClientCreatedMail($client->name));
        
        $originalName = strtolower($client->getOriginal('name'));
        $names = explode(' ', $originalName);
        foreach ($names as $name) {
            $keys = Redis::keys('*' . $name . '*');
            foreach ($keys as $key) {
                Cache::forget($key);
            }
        }
        Cache::forget('clients.list');
    }

    public function updated(Client $client): void
    {
        $originalName = strtolower($client->getOriginal('name'));
        $names = explode(' ', $originalName);
        foreach ($names as $name) {
            $keys = Redis::keys('*' . $name . '*');
            foreach ($keys as $key) {
                Cache::forget($key);
            }
        }
        Cache::forget('clients.list');
    }
}