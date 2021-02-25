<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\AddressType;
use App\Models\Company;
use App\Models\Person;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
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
        $companies = Company::all();

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $addresses = Address::all();
        $people = Person::all();
        $addressTypes = AddressType::all();
        return view('companies.create', compact('addresses','people','addressTypes'));
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
            'email',
            'phone',
            'note'
        ]);

        if($request->new_address == 'on'){
            $request->validate([
                'street'=> 'required',
                'number',
                'zip',
                'city'=> 'required'
            ]);
        }

        $company = Company::create($request->all());

        $company->people()->attach($request->people);
        $company->addresses()->attach($request->addresses);

        if($request->new_address == 'on'){

            $address = Address::create($request->all());

            $address->addressType()->associate($request->address_type_id);
            $address->save();

            $address->companies()->attach($company);
        }

        return redirect()->route('companies.index')
            ->with('success', 'Úspěšně přidána firma '.$request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return Application|Factory|View|Response
     */
    public function show(Company $company)
    {
        $addresses = Address::with('companies');
        $people = Person::with('companies');
        return view('companies.show', compact('company','addresses','people'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return Application|Factory|View|Response
     */
    public function edit(Company $company)
    {
        $addresses = Address::all();
        $people = Person::all();
        $addressTypes = AddressType::all();
        return view('companies.edit', compact('company','addresses','people','addressTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(Request $request, Company $company): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email',
            'phone',
            'note'
        ]);

        if($request->new_address == 'on'){
            $request->validate([
                'street'=> 'required',
                'number',
                'zip',
                'city'=> 'required'
            ]);
        }

        $company->update($request->all());

        $company->people()->sync($request->people);
        $company->addresses()->sync($request->addresses);

        if($request->new_address == 'on'){

            $address = Address::create($request->all());

            $address->addressType()->associate($request->address_type_id);
            $address->save();

            $address->companies()->attach($company);
        }

        return redirect()->route('companies.index')
            ->with('success', 'Úspěšně upravena firma '.$company->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Úspěšně smazána firma '.$company->name);
    }
}
