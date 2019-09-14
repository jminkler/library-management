<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class AuthorCreated implements ShouldBeStored
{
    public $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }
}
