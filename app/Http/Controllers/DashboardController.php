<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Event;
use App\Models\Team;
use App\Models\Place;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::count();
        $posts = Post::count();
        $events = Event::count();
        $teams = Team::count();
        return view('panel.dashboard', compact('places', 'posts', 'events', 'teams'));
    }
}
