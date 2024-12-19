<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    |
    | {route}/{template}/{filename}
    |
    | Examples: "images", "img/cache"
    |
    */

    'route' => 'imagenes',

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submitted
    | by URI.
    |
    | Define as many directories as you like.
    |
    */

    'paths' => array(
        // public_path('upload'),
        public_path('img'),
        public_path('storage'),
        public_path('storage/banners'),
        public_path('storage/posts'),
        public_path('storage/events'),
        public_path('storage/users'),
        public_path('storage/team'),
        public_path('storage/post_galery'),
        public_path('storage/places'),
        public_path('storage/place_galery'),
        public_path('storage/logo_main'),
        public_path('storage/logo_panel'),
    ),

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
    */

    'templates' => array(
        'small' => 'Intervention\Image\Templates\Small',
        'medium' => 'Intervention\Image\Templates\Medium',
        'large' => 'Intervention\Image\Templates\Large',
        'banner' => App\Intervention\Templates\Banner::class,
        'ultimo-evento' => App\Intervention\Templates\LastEvent::class,
        'ultima-noticia' => App\Intervention\Templates\LastNew::class,
        'equipo' => App\Intervention\Templates\Team::class,
        'slider' => App\Intervention\Templates\Slider::class,
        'noticia' => App\Intervention\Templates\SingleNew::class,
        'usuario-autor' => App\Intervention\Templates\UserAuthor::class,
        'autor' => App\Intervention\Templates\Author::class,
        'noticia-previa' => App\Intervention\Templates\PrevNext::class,
        'noticia-proxima' => App\Intervention\Templates\PrevNext::class,
        'autor' => App\Intervention\Templates\Author::class,
        'galeria' => App\Intervention\Templates\PostGaleryImage::class,
        'ultimas-fotos' => App\Intervention\Templates\PostGaleryImageLast::class,
        'logo-main' => App\Intervention\Templates\LogoMain::class,
        'logo-panel' => App\Intervention\Templates\LogoPanel::class,
    ),

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */

    'lifetime' => 43200,

);
