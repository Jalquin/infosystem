<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatusController extends Controller
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
        $statuses = Status::all();

        return view('statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('statuses.create');
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
            'name' => 'required',
        ]);

        Status::create($request->all());

        return redirect()->route('statuses.index')
            ->with('success', 'Úspěšně přidán status ' . $request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param Status $status
     * @return Application|Factory|View|Response
     */
    public function show(Status $status)
    {
        return view('statuses.show', compact('status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Status $status
     * @return Application|Factory|View|Response
     */
    public function edit(Status $status)
    {
        return view('statuses.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Status $status
     * @return RedirectResponse
     */
    public function update(Request $request, Status $status): RedirectResponse
    {
        $request->validate([
            'name' => 'required'
        ]);

        $status->update($request->all());

        return redirect()->route('statuses.index')
            ->with('success', 'Úspěšně upraven status ' . $status->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Status $status
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Status $status): RedirectResponse
    {
        $status->delete();

        return redirect()->route('statuses.index')
            ->with('success', 'Úspěšně smazán status ' . $status->name);
    }
}
