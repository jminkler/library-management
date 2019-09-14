<?php

namespace App\Events;
use Spatie\EventProjector\ShouldBeStored;

class AuthorAdded implements ShouldBeStored
{
    public $name, $uuid;

    public function __construct(string $uuid, string $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
    }
}
