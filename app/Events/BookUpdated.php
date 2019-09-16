<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class BookUpdated implements ShouldBeStored
{
    public $uuid, $attributes;

    public function __construct(string $uuid, array $attributes)
    {
        $this->uuid = $uuid;
        $this->attributes = $attributes;
    }
}
