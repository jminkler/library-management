<?php

namespace App\Projectors;

use App\Status;
use App\Events\StatusCreated;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

final class StatusProjector implements Projector
{
    use ProjectsEvents;

    public function onStatusCreated(StatusCreated $event)
    {
        Status::create($event->attributes);
    }
}
