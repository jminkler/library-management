<?php

namespace App\Transformers;


use App\Book;
use App\BookDescription;
use App\Transformers\AuthorTransformer;
use App\Transformers\DescriptionTransformer;
use League\Fractal;

class BookTransformer extends Fractal\TransformerAbstract
{
    protected $defaultIncludes = [
        'descriptions'
    ];

    public function transform(Book $book) : array
    {
        return [
	        'id'      => (int) $book->id,
	        'title'   => $book->title,
	        'isbn'    => $book->isbn,
            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/books/'.$book->id,
                ]
            ],
	    ];
    }

    public function includeAuthors(Book $book)
    {
        $authors =  $book->authors;

        return $this->collection($authors, new AuthorTransformer);
    }

    public function includeDescriptions(Book $book)
    {
        $descriptions =  $book->descriptions;

        return $this->collection($descriptions, new DescriptionTransformer);
    }
}