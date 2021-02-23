<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PositionController extends Controller
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
        $positions = Position::all();

        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('positions.create');
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

        Position::create($request->all());

        return redirect()->route('positions.index')
            ->with('success', 'Úspěšně přidána pozice ' . $request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param Position $position
     * @return Application|Factory|View|Response
     */
    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Position $position
     * @return Application|Factory|View|Response
     */
    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Position $position
     * @return RedirectResponse
     */
    public function update(Request $request, Position $position): RedirectResponse
    {
        $request->validate([
            'name' => 'required'
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index')
            ->with('success', 'Úspěšně upravena pozice ' . $position->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Position $position
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Position $position): RedirectResponse
    {
        $position->delete();

        return redirect()->route('positions.index')
            ->with('success', 'Úspěšně smazána pozice ' . $position->name);
    }
}
