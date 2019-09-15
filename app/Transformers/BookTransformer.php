<?php

namespace App\Transformers;


use App\Book;
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
            'status' => $book->status,
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
