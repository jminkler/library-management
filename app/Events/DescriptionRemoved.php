<?php


namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class DescriptionRemoved implements ShouldBeStored
{
    public $uuid;
    public $description;

    public function __construct(string $uuid, $description)
    {
        $this->uuid = $uuid;
        $this->description = $description;
    }
}
