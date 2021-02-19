<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $items = Item::with('categories')->get();
        $positions = Position::all();
        $categories = Category::all();

        if ($request->position_id == null) {
            $positionItems = Item::all();
        } else {
            $positionItems = Position::find($request->position_id)->items;
        }

        if ($request->categories == null) {
            $categoriesItem = Item::all();
        } else {
            $categoriesItems = Category::whereIn('id', $request->categories)->with('items')->get();
            foreach ($categoriesItems as $categoriesItem) {
                $categoriesItem = $categoriesItem->items;
            }
        }

        return view('items.index', compact('items', 'positionItems', 'positions', 'categories', 'categoriesItem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        $positions = Position::all();
        return view('items.create', compact('categories', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $image = null;
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('items_img', $image, 'public');
        }

        $request->validate([
            'name' => 'required',
            'description',
            'amount' => 'required',
            'min_amount',
            'price'
        ]);

        $item = Item::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'amount' => $request->amount,
            'min_amount' => $request->min_amount,
            'price' => $request->price
        ]);

        $item->position()->associate($request->position_id);
        $item->save();

        $item->categories()->attach($request->categories);

        return redirect()->route('items.index')
            ->with('success', 'Úspěšně přidána položka ' . $request->name . '.');
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return Response
     */
    public function show(Item $item)
    {
        $categories = Category::with('items')->get();
        $position = Position::with('items')->get();
        return view('items.show', compact('item', 'categories', 'position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Item $item
     * @return Response
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        $positions = Position::all();
        return view('items.edit', compact('item', 'categories', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return Response
     */
    public function update(Request $request, Item $item)
    {
        $image = $item->image;
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        if ($request->hasFile('image')) {
            if ($image) {
                Storage::delete('/public/items_img/' . $image);
            }
            $image = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('items_img', $image, 'public');
        }

        $request->validate([
            'name' => 'required',
            'description',
            'amount' => 'required',
            'min_amount',
            'price',
        ]);

        $item->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'amount' => $request->amount,
            'min_amount' => $request->min_amount,
            'price' => $request->price
        ]);

        $item->position()->associate($request->position_id);
        $item->save();

        $item->categories()->sync($request->categories);

        return redirect()->route('items.index')
            ->with('success', 'Úspěšně upravena položka ' . $item->name . '.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        Storage::delete('/public/items_img/' . $item->image);

        return redirect()->route('items.index')
            ->with('success', 'Úspěšně smazána pložka ' . $item->name);
    }

    public function addAmount($id, Item $item)
    {
        $item = Item::findOrFail($id);
        $amount = $item->amount + 1;
        $item->update([
            'amount' => $amount
        ]);
        return redirect()->route('items.index')
            ->with('success', 'Úspěšně přidáno množství položce ' . $item->name . '. Konečné množství je : ' . $item->amount);
    }

    public function subtractAmount($id, Item $item)
    {
        $item = Item::findOrFail($id);
        $amount = $item->amount - 1;
        $item->update([
            'amount' => $amount
        ]);
        return redirect()->route('items.index')
            ->with('success', 'Úspěšně odebráno množství položce ' . $item->name . '. Konečné množství je : ' . $item->amount);
    }
}
