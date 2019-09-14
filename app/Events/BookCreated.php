<?php

namespace App\Events;
use Spatie\EventProjector\ShouldBeStored;

class BookCreated implements ShouldBeStored
{
    public $bookAttributes;

    public function __construct(array $bookAttributes)
    {
        $this->bookAttributes = $bookAttributes;
    }
}
