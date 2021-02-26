<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\AddressType;
use App\Models\Company;
use App\Models\Job;
use App\Models\Person;
use App\Models\Role;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PersonController extends Controller
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
        $people = Person::all();

        return view('people.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $addresses = Address::all();
        $companies = Company::all();
        $jobs = Job::all();
        $roles = Role::all();
        $addressTypes = AddressType::all();
        return view('people.create', compact('addresses', 'companies','jobs','roles','addressTypes'));
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

        $person = Person::create($request->all());

        $person->role()->associate($request->role_id);
        $person->save();

        $person->companies()->attach($request->companies);
        $person->addresses()->attach($request->addresses);

        if($request->new_address == 'on'){

            $address = Address::create($request->all());

            $address->addressType()->associate($request->address_type_id);
            $address->save();

            $address->people()->attach($person);
        }

        $person->jobs()->attach($request->jobs);

        return redirect()->route('people.index')
            ->with('success', 'Úspěšně přidána osoba '.$request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param Person $person
     * @return Application|Factory|View|Response
     */
    public function show(Person $person)
    {

        $jobs = Job::with('people')->get();
        $address = Address::with('people')->get();
        $companies = Company::with('people')->get();
        $role = Role::with('people')->get();
        return view('people.show', compact('person','jobs','address','companies','role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Person $person
     * @return Application|Factory|View|Response
     */
    public function edit(Person $person)
    {
        $addresses = Address::all();
        $companies = Company::all();
        $jobs = Job::all();
        $roles = Role::all();
        $addressTypes = AddressType::all();
        return view('people.edit', compact('person','addresses', 'companies','jobs','roles','addressTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Person $person
     * @return RedirectResponse
     */
    public function update(Request $request, Person $person): RedirectResponse
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

        $person->update($request->all());

        $person->role()->associate($request->role_id);
        $person->save();

        $person->companies()->sync($request->companies);
        $person->addresses()->sync($request->addresses);

        if($request->new_address == 'on'){

            $address = Address::create($request->all());

            $address->addressType()->associate($request->address_type_id);
            $address->save();

            $address->people()->attach($person);
        }

        $person->jobs()->sync($request->jobs);

        return redirect()->route('people.index')
            ->with('success', 'Úspěšně upravena osoba '.$person->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Person $person
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Person $person): RedirectResponse
    {
        $person->delete();

        return redirect()->route('people.index')
            ->with('success', 'Úspěšně smazána osoba '.$person->name);
    }
}
