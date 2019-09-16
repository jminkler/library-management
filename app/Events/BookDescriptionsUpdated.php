<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class BookDescriptionsUpdated implements ShouldBeStored
{
    public $uuid;
    public $attributes;

    public function __construct(string $uuid, array $attributes)
    {
        $this->uuid = $uuid;
        $this->attributes = $attributes;
    }
}
