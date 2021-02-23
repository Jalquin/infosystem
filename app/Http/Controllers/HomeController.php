<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
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
        $users = User::count();

        $widget = [
            'users' => $users
        ];

        $lowItems = Item::where('is_enough', 0)->get();

        return view('home', compact('widget', 'lowItems'));
    }
}
