<?php

namespace App\Intervention\Templates;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class LogoMain implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(125, 30);
    }
}
