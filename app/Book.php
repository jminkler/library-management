<?php

namespace App;

use App\Events\BookCreated;
use App\Events\DescriptionAdded;
use App\Events\DescriptionCreated;
use App\Events\AuthorAdded;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Book extends Model
{
    protected $fillable = ['isbn', 'uuid', 'title'];

    public static function createWithAttributes(array $attributes): Book
    {
        $attributes['uuid'] = (string) Uuid::uuid4();

        event(new BookCreated($attributes));

        $book = static::uuid($attributes['uuid']);

        if (isset($attributes['descriptions'])) {
            foreach ($attributes['descriptions'] as $description) {
                $book->addDescription($description['description'], $description['language']);
            }
        }

        if (isset($attributes['authors'])) {
            foreach ($attributes['authors'] as $author) {
                $book->addAuthor($author->name);
            }
        }

        return $book;
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

    public function descriptions()
    {
        return $this->hasMany(BookDescription::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
    
}
