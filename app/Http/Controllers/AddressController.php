<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\AddressType;
use App\Models\Company;
use App\Models\Job;
use App\Models\Person;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
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
        $addresses = Address::all();

        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $jobs = Job::all();
        $people = Person::all();
        $companies = Company::all();
        $addressTypes = AddressType::all();
        return view('addresses.create', compact('jobs', 'people', 'companies', 'addressTypes'));
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
            'street'=> 'required',
            'number',
            'zip',
            'city'=> 'required'
        ]);

        $address = Address::create($request->all());

        $address->addressType()->associate($request->address_type_id);
        $address->save();

        return redirect()->route('addresses.index')
            ->with('success', 'Úspěšně přidána adresa '.$request->street.' '.$request->number.'.');
    }

    /**
     * Display the specified resource.
     *
     * @param Address $address
     * @return Application|Factory|View|Response
     */
    public function show(Address $address)
    {
        $jobs = Job::with('addresses')->get();
        $people = Person::with('addresses')->get();
        $companies = Company::with('addresses')->get();
        $addressType = AddressType::with('addresses')->get();
        return view('addresses.show', compact('address', 'jobs', 'people', 'companies', 'addressType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Address $address
     * @return Application|Factory|View|Response
     */
    public function edit(Address $address)
    {
        $jobs = Job::all();
        $people = Person::all();
        $companies = Company::all();
        $addressTypes = AddressType::all();
        return view('addresses.edit', compact('address', 'jobs', 'people', 'companies', 'addressTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Address $address
     * @return RedirectResponse
     */
    public function update(Request $request, Address $address): RedirectResponse
    {
        $request->validate([
            'street'=> 'required',
            'number',
            'zip',
            'city'=> 'required'
        ]);

        $address->update($request->all());

        $address->addressType()->associate($request->address_type_id);
        $address->save();

        return redirect()->route('addresses.index')
            ->with('success', 'Úspěšně upravena adresa '.$address->street.' '.$address->number.'.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Address $address): RedirectResponse
    {
        $address->delete();

        return redirect()->route('addresses.index')
            ->with('success', 'Úspěšně smazána adresa '.$address->street.' '.$address->number.'.');
    }
}
