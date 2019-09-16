<?php

namespace App\Transformers;

use App\BookDescription;
use League\Fractal;

class DescriptionTransformer extends Fractal\TransformerAbstract
{

    public function transform(BookDescription $desc): array
    {
        return [
            'id' => $desc->id,
            'uuid' => $desc->uuid,
            'description' => $desc->description,
            'language' => $desc->language,
        ];
    }
}
