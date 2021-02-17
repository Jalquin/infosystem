<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::with('categories')->get();

        return view('items.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $positions = Position::all();
        return view('items.create', compact('categories','positions'));
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
        if($request->hasFile('image')){
            $image = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('items_img', $image, 'public');
        }

        $request->validate([
            'name'=> 'required',
            'description',
            'amount'=> 'required',
            'min_amount',
            'price'
        ]);

        $item = Item::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'image' => $image,
            'amount'=> $request->amount,
            'min_amount'=> $request->min_amount,
            'price'=> $request->price
        ]);

        $item->position()->associate($request->position_id);
        $item->save();

        $item->categories()->attach($request->categories);

        return redirect()->route('items.index')
            ->with('success','Úspěšně přidána položka '.$request->name.'.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $categories = Category::with('items')->get();
        $position = Position::with('items')->get();
        return view('items.show',compact('item','categories','position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        $positions = Position::all();
        return view('items.edit',compact('item', 'categories', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
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
            'min_amount',
            'price',
        ]);

        $item->update([
            'name'=> $request->name,
            'description'=> $request->description,
            'image' => $image,
            'amount'=> $request->amount,
            'min_amount'=> $request->min_amount,
            'price'=> $request->price
        ]);

        $item->position()->associate($request->position_id);
        $item->save();

        $item->categories()->sync($request->categories);

        return redirect()->route('items.index')
            ->with('success','Úspěšně upravena položka '.$item->name.'.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        Storage::delete('/public/items_img/'.$item->image);

        return redirect()->route('items.index')
            ->with('success','Úspěšně smazána pložka '.$item->name);
    }

    public function addAmount($id, Item $item){
        $item = Item::findOrFail($id);
        $amount = $item->amount + 1;
        $item->update([
            'amount'=> $amount
        ]);
        return redirect()->route('items.index')
            ->with('success','Úspěšně přidáno množství položce '.$item->name.'. Konečné množství je : '.$item->amount);
    }

    public function subtractAmount($id, Item $item){
        $item = Item::findOrFail($id);
        $amount = $item->amount - 1;
        $item->update([
            'amount'=> $amount
        ]);
        return redirect()->route('items.index')
            ->with('success','Úspěšně odebráno množství položce '.$item->name.'. Konečné množství je : '.$item->amount);
    }
}
