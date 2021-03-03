<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Job;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
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
     * @return Renderable
     */
    public function index(): Renderable
    {
        $jobs = Job::whereIn('status_id', [1, 2, 3, 4, 5, 6])->get();

        $lowItems = Item::where('is_enough', 0)->get();

        return view('home', compact('lowItems', 'jobs'));
    }
}
