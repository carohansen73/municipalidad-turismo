<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\PostGaleryImage;
use App\Models\SiteSocialNetwork;

class FooterComposer
{

    public function compose(View $view)
    {
        $post_galery_images = PostGaleryImage::orderBy('created_at', 'DESC')->get()->take(8);

        $site_social_networks = SiteSocialNetwork::orderBy('url', 'ASC')->get()->take(4);

        $view->with('post_galery_images', $post_galery_images)
            ->with('site_social_networks', $site_social_networks);
    }
}
