<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class DescriptionAdded implements ShouldBeStored
{
    public $uuid, $description, $language;

    public function __construct(string $uuid, string $description, string $language)
    {
        $this->uuid = $uuid;
        $this->description = $description;
        $this->language = $language;
    }
}
