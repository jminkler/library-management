<?php

namespace App\Projectors;

use App\Author;
use App\Events\AuthorCreated;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

final class AuthorProjector implements Projector
{
    use ProjectsEvents;

    public function onAuthorCreated(AuthorCreated $event)
    {
        $author = Author::create($event->attributes);
    }

    public function onAuthorUpdated(AuthorUpdated $event)
    {
        $author = Author::uuid($event->uuid);
        $author->name = $event->name;
        $author->save();
    }
}
