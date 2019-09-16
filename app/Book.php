<?php

namespace App;

use App\Events;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = ['isbn', 'uuid', 'title'];

    public static function createWithAttributes(array $attributes): Book
    {
        $attributes['uuid'] = (string) Uuid::uuid4();

        event(new Events\BookCreated($attributes));

        $book = static::uuid($attributes['uuid']);
        self::addDescriptions($attributes, $book);
        self::addAuthors($attributes, $book);

        return $book;
    }

    public static function updateWithAttributes(string $uuid, array $attributes): Book
    {
        event(new Events\BookUpdated($uuid, $attributes));

        return self::uuid($uuid);
    }

    public static function updateAuthors(string $uuid, array $attributes): Book
    {
        event(new Events\BookAuthorsUpdated($uuid, $attributes));

        return self::uuid($uuid);
    }

    public static function updateDescriptions(string $uuid, array $attributes): Book
    {
        event(new Events\BookDescriptionsUpdated($uuid, $attributes));

        return self::uuid($uuid);
    }


    /**
     * @param array $attributes
     * @param Book|null $book
     * @return void
     */
    protected static function addDescriptions(array $attributes, Book $book): void
    {
        if (isset($attributes['descriptions'])) {
            $descriptions = $attributes['descriptions'];
            if (isset($attributes['descriptions']['data'])) {
                $descriptions = $attributes['descriptions']['data'];
            }
            foreach ($descriptions as $description) {
                $book->addDescription($description['description'], $description['language']);
            }
        }
    }

    /**
     * @param array $attributes
     * @param Book|null $book
     */
    protected static function addAuthors(array $attributes, Book $book): void
    {
        if (isset($attributes['authors'])) {
            $authors = $attributes['authors'];
            if (isset($attributes['authors']['data'])) {
                $authors = $attributes['authors']['data'];
            }
            foreach ($authors as $author) {
                $author = isset($author['name'])
                    ? $author['name']
                    : $author;
                $book->addAuthor($author);
            }
        }
    }

    public function remove()
    {
        event(new Events\BookDeleted($this->uuid));
    }

    public function addDescription(string $description, string $language = 'en')
    {
        event(new Events\DescriptionAdded($this->uuid, $description, $language));
    }

    public function addAuthor(string $author)
    {
        event(new Events\AuthorAdded($this->uuid, $author));
    }

    public static function checkout(string $isbn)
    {
        $book = self::isbn($isbn);

        event(new Events\BookWasCheckedOut($book->uuid));

        return $book;
    }

    public static function checkin(string $isbn)
    {
        $book = self::isbn($isbn);

        event(new Events\BookWasCheckedIn($book->uuid));

        return $book;
    }

    public static function uuid(string $uuid): ?Book
    {
        return static::where('uuid', $uuid)->first();
    }

    public static function isbn(string $isbn): ?Book
    {
        return static::where('isbn', $isbn)->first();
    }

    public function descriptions()
    {
        return $this->hasMany(BookDescription::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function getRouteKeyName()
    {
        return 'isbn';
    }
}
