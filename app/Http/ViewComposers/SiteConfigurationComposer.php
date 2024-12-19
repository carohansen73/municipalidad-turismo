<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Models\SiteConfiguration;

class SiteConfigurationComposer
{
    public function compose(View $view)
    {
        $siteConfiguration = SiteConfiguration::findOrFail(1);

        $view->with('siteConfiguration', $siteConfiguration);
    }
}