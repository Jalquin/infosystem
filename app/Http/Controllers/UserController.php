<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $users = User::all();

        $usersCount = User::count();

        $widget = [
            'usersCount' => $usersCount
        ];

        return view('users.index', compact('widget', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $admin = null;
        if ($request->admin == 'on')
            $admin = 1;
        else
            $admin = 0;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin' => $admin
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Úspěšně přidán uživatel ' . $request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View|Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View|Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',]
        ]);

        $admin = null;
        if ($request->admin == 'on')
            $admin = 1;
        else
            $admin = 0;
        if ($request->password)
            $password = Hash::make($request->password);
        else
            $password = $user->password;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'admin' => $admin
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Úspěšně upraven uživatel ' . $user->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Úspěšně smazán uživatel ' . $user->name);
    }
}
