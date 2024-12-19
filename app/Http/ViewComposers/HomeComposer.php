<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Models\Banner;
use App\Models\Post;
use App\Models\Event;
use App\Models\SiteConfiguration;
use App\Models\Team;
use App\Models\Place;

class HomeComposer
{

    public function compose(View $view)
    {
        $banner = Banner::where('publish', 1)->get()->first();

        $places = Place::where('publish', 1)->where('place_category_id',5)->orderBy('title', 'ASC')->get();
        
        $circuits = Place::where('publish', 1)->where('place_category_id',6)->orderBy('title', 'ASC')->get();
        
        $posts = Post::where('publish', 1)->orderBy('publication_date', 'DESC')->get()->take(4);

        $events = Event::where('publish', 1)->orderBy('publication_date', 'ASC')->get()->take(4);

        $event_1 = $events->pop();
        $event_2 = $events->pop();
        $event_3 = $events->pop();
        $event_4 = $events->pop();

        $members = Team::where('publish', 1)->orderBy('name', 'ASC')->get();

        $view->with('posts', $posts)
            ->with('banner', $banner)
            ->with('places', $places)
            ->with('circuits', $circuits)
            ->with('event_1', $event_1)
            ->with('event_2', $event_2)
            ->with('event_3', $event_3)
            ->with('event_4', $event_4)
            ->with('members', $members);
    }
}
