<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users
        ];

        $lowItems = Item::where('is_enough', 0)->get();

        return view('home', compact('widget', 'lowItems'));
    }
}
