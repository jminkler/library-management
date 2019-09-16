<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class AuthorUpdated implements ShouldBeStored
{
    public $uuid;
    public $name;

    public function __construct($uuid, $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
    }
}
