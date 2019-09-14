<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class BookWasCheckedOut implements ShouldBeStored
{
    public $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }
}
