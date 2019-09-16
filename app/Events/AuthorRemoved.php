<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class AuthorRemoved implements ShouldBeStored
{
    public $uuid;
    public $author;

    public function __construct(string $uuid, $author)
    {
        $this->uuid = $uuid;
        $this->author = $author;
    }
}
