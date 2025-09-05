<?php

namespace App\Http\Controllers;

use App\Models\Advance;
use App\Models\Farmer;
use Illuminate\Http\Request;

class AdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advances = Advance::with('farmer')->latest()->paginate(10);
        return view('advances.index', compact('advances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $farmers = Farmer::all();
        return view('advances.create', compact('farmers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
        ]);

        Advance::create($request->all());

        return redirect()->route('advances.index')->with('success', 'Advance recorded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advance $advance)
    {
        $advance->load('farmer');
        return view('advances.show', compact('advance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advance $advance)
    {
        $farmers = Farmer::all();
        return view('advances.edit', compact('advance', 'farmers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advance $advance)
    {
        $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
        ]);

        $advance->update($request->all());

        return redirect()->route('advances.index')->with('success', 'Advance updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advance $advance)
    {
        $advance->delete();

        return redirect()->route('advances.index')->with('success', 'Advance deleted successfully!');
    }
}
