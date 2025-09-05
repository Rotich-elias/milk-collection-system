<?php

namespace App\Http\Controllers;

use App\Models\MilkCollection;
use App\Models\Farmer;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = MilkCollection::with('farmer')->latest()->paginate(10);
        return view('collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $farmers = Farmer::all();
        return view('collections.create', compact('farmers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'date' => 'required|date',
            'quantity' => 'required|numeric|min:0',
        ]);

        MilkCollection::create($request->all());

        return redirect()->route('collections.index')->with('success', 'Milk collection recorded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MilkCollection $collection)
    {
        $collection->load('farmer');
        return view('collections.show', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MilkCollection $collection)
    {
        $farmers = Farmer::all();
        return view('collections.edit', compact('collection', 'farmers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MilkCollection $collection)
    {
        $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'date' => 'required|date',
            'quantity' => 'required|numeric|min:0',
        ]);

        $collection->update($request->all());

        return redirect()->route('collections.index')->with('success', 'Milk collection updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MilkCollection $collection)
    {
        $collection->delete();

        return redirect()->route('collections.index')->with('success', 'Milk collection deleted successfully!');
    }
}
