<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\AddressType;
use App\Models\Item;
use App\Models\Job;
use App\Models\Person;
use App\Models\Status;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobController extends Controller
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
        $jobs = Job::all();

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $statuses = Status::all();
        $items = Item::all();
        $addresses = Address::all();
        $people = Person::all();
        $addressTypes = AddressType::all();
        return view('jobs.create', compact('statuses','items','addresses','people','addressTypes'));
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
            'number' => 'required',
            'name' => 'required',
            'date',
            'description',
            'tender_number',
            'invoice_number'
        ]);

        if($request->new_address == 'on'){
            $request->validate([
                'street'=> 'required',
                'number',
                'zip',
                'city'=> 'required'
            ]);
        }

        $job = Job::create($request->all());

        $job->status()->associate($request->status_id);
        $job->save();

        $job->addresses()->attach($request->addresses);

        if($request->new_address == 'on'){

            $address = Address::create([
                'street' => $request->street,
                'number' =>$request->address_number,
                'zip' => $request->zip,
                'city'=> $request->city
            ]);

            $address->addressType()->associate($request->address_type_id);
            $address->save();

            $address->jobs()->attach($job);
        }

        $job->people()->attach($request->people);
        $job->items()->attach($request->items);

        return redirect()->route('jobs.index')
            ->with('success', 'Úspěšně přidána zakázka '.$request->number);
    }

    /**
     * Display the specified resource.
     *
     * @param Job $job
     * @return Application|Factory|View|Response
     */
    public function show(Job $job)
    {
        $people = Person::with('jobs')->get();
        $addresses = Address::with('jobs')->get();
        $items = Item::with('jobs')->get();
        $status = Status::with('jobs')->get();
        return view('jobs.show', compact('job','people','addresses','items','status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Job $job
     * @return Application|Factory|View|Response
     */
    public function edit(Job $job)
    {
        $statuses = Status::all();
        $items = Item::all();
        $addresses = Address::all();
        $people = Person::all();
        $addressTypes = AddressType::all();
        return view('jobs.edit', compact('job','statuses','items','addresses','people','addressTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Job $job
     * @return RedirectResponse
     */
    public function update(Request $request, Job $job): RedirectResponse
    {
        $request->validate([
            'number' => 'required',
            'name' => 'required',
            'date',
            'description',
            'tender_number',
            'invoice_number'
        ]);

        if($request->new_address == 'on'){
            $request->validate([
                'street'=> 'required',
                'address_number',
                'zip',
                'city'=> 'required'
            ]);
        }

        $job->update($request->all());

        $job->status()->associate($request->status_id);
        $job->save();

        $job->addresses()->sync($request->addresses);

        if($request->new_address == 'on'){

            $address = $address = Address::create([
                'street' => $request->street,
                'number' =>$request->address_number,
                'zip' => $request->zip,
                'city'=> $request->city
            ]);

            $address->addressType()->associate($request->address_type_id);
            $address->save();

            $address->jobs()->attach($job);
        }

        $job->people()->sync($request->people);
        $job->items()->sync($request->items);

        return redirect()->route('jobs.index')
            ->with('success', 'Úspěšně upravena zakázka '.$job->number);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Job $job
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Job $job): RedirectResponse
    {
        $job->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Úspěšně smazána zakázka '.$job->number);
    }
}
