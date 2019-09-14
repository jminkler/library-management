<?php

namespace App\Projectors;

use App\Events\DescriptionCreated;
use App\BookDescription;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

final class DescriptionProjector implements Projector
{
    use ProjectsEvents;

    public function onDescriptonCreated(DescriptionCreated $event)
    {
        BookDescription::create($event->attributes);
    }
}
