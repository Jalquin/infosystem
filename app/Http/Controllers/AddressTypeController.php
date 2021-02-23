<?php

namespace App\Http\Controllers;

use App\Models\AddressType;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressTypeController extends Controller
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
        $addressTypes = AddressType::all();

        return view('address_types.index', compact('addressTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('address_types.create');
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

        AddressType::create($request->all());

        return redirect()->route('address_types.index')
            ->with('success', 'Úspěšně přidán typ adresy ' . $request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param AddressType $addressType
     * @return Application|Factory|View|Response
     */
    public function show(AddressType $addressType)
    {
        return view('address_types.show', compact('addressType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AddressType $addressType
     * @return Application|Factory|View|Response
     */
    public function edit(AddressType $addressType)
    {
        return view('address_types.edit', compact('addressType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param AddressType $addressType
     * @return RedirectResponse
     */
    public function update(Request $request, AddressType $addressType): RedirectResponse
    {
        $request->validate([
            'name' => 'required'
        ]);

        $addressType->update($request->all());

        return redirect()->route('address_types.index')
            ->with('success', 'Úspěšně upraven typ adresy ' . $addressType->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AddressType $addressType
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(AddressType $addressType): RedirectResponse
    {
        $addressType->delete();

        return redirect()->route('address_types.index')
            ->with('success', 'Úspěšně smazán typ adresy ' . $addressType->name);
    }
}
