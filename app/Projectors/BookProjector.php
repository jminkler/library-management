<?php

namespace App\Projectors;

use App\Book;
use App\Events\BookCreated;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

final class BookProjector implements Projector
{
    use ProjectsEvents;

    public function onBookCreated(BookCreated $event)
    {
        Book::create($event->bookAttributes);
    }
}
