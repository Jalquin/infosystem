<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use Illuminate\Support\Facades\Storage;

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
        $image = null;
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        if($request->hasFile('image')){
            $image = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('items_img', $image, 'public');
        }

        $request->validate([
            'name'=> 'required',
            'description',
            'amount'=> 'required',
            'min_amount'=> 'required',
            'price'
        ]);

        Items::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'image' => $image,
            'amount'=> $request->amount,
            'min_amount'=> $request->min_amount,
            'price'=> $request->price
        ]);

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
        $image = $item->image;
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        if($request->hasFile('image')){
            if($image){
                Storage::delete('/public/items_img/'.$image);
            }
            $image = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('items_img', $image, 'public');
        }

        $request->validate([
            'name'=> 'required',
            'description',
            'amount'=> 'required',
            'min_amount'=> 'required',
            'price'
        ]);

        $item->update([
            'name'=> $request->name,
            'description'=> $request->description,
            'image' => $image,
            'amount'=> $request->amount,
            'min_amount'=> $request->min_amount,
            'price'=> $request->price
        ]);

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
        Storage::delete('/public/items_img/'.$item->image);

        return redirect()->route('items.index')
            ->with('success','Úspěšně smazáno');
    }

    public function addAmount($id, Items $item){
        $item = Items::findOrFail($id);
        $amount = $item->amount + 1;
        $item->update([
            'amount'=> $amount
        ]);
        return redirect()->route('items.index')
            ->with('success','Úspěšně přidáno množství položce '.$item->name);
    }


    public function subtractAmount($id, Items $item){
        $item = Items::findOrFail($id);
        $amount = $item->amount - 1;
        $item->update([
            'amount'=> $amount
        ]);
        return redirect()->route('items.index')
            ->with('success','Úspěšně odebráno množství položce '.$item->name);
    }
}
