<?php

namespace App\Intervention\Templates;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Team implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(263, 300);
    }
}
