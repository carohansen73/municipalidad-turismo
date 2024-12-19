<?php

namespace App\Intervention\Templates;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Author implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(123, 122);
    }
}
