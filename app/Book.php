<?php

namespace App;

use App\Events\BookCreated;
use App\Events\DescriptionAdded;
use App\Events\AuthorAdded;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Book extends Model
{
    protected $fillable = ['isbn', 'uuid'];

    public static function createWithAttributes(array $attributes): Book
    {
        $attributes['uuid'] = (string) Uuid::uuid4();

        event(new BookCreated($attributes));

        return static::uuid($attributes['uuid']);
    }

    public function addDescription(string $description, string $language = 'en')
    {
        event(new DescriptionAdded($this->uuid, $description, $language));
    }

    public function addAuthor(string $author)
    {
        event(new AuthorAdded($this->uuid, $author));
    }

    public static function uuid(string $uuid): ?Book
    {
        return static::where('uuid', $uuid)->first();
    }
}
