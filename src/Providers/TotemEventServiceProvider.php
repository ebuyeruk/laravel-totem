<?php

namespace Ebuyer\Totem\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class TotemEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        'Ebuyer\Totem\Events\Created' => ['Ebuyer\Totem\Listeners\BustCache', 'Ebuyer\Totem\Listeners\BuildCache'],
        'Ebuyer\Totem\Events\Updated' => ['Ebuyer\Totem\Listeners\BustCache', 'Ebuyer\Totem\Listeners\BuildCache'],
        'Ebuyer\Totem\Events\Activated' => ['Ebuyer\Totem\Listeners\BustCache', 'Ebuyer\Totem\Listeners\BuildCache'],
        'Ebuyer\Totem\Events\Deactivated' => ['Ebuyer\Totem\Listeners\BustCache', 'Ebuyer\Totem\Listeners\BuildCache'],
        'Ebuyer\Totem\Events\Deleting' => ['Ebuyer\Totem\Listeners\BustCacheImmediately'],
    ];
}
