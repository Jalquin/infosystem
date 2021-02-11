<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Items::all();

        return view('items.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'description',
            'image',
            'amount'=> 'required',
            'min_amount'=> 'required',
            'price'
        ]);

        Items::create($request->all());

        return redirect()->route('items.index')
            ->with('success','Úspěšně přidáno.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Items  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Items $item)
    {
        return view('items.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Items  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $item)
    {
        return view('items.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Items $item)
    {
        $request->validate([
            'name'=> 'required',
            'description',
            'image',
            'amount'=> 'required',
            'min_amount'=> 'required',
            'price'
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')
            ->with('success','Úspěšně upraveno');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Items  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success','Úspěšně smazáno');
    }
/*
    public function create(Request $request)
    {
        $item = new Items();

        $item->name = $request->input('name');
        $item->description = $request->input('description');

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/items/', $filename);
            $item->image = $filename;
        }
        else{
            return $request;
            $item->image = '';
        }

        $item->amount = $request->input('amount');
        $item->price = $request->input('price');

        $item->save();

        return view('items.create')->with('item',$item);
    }*/
}
