<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farmers = Farmer::all();
        return view('farmers.index', compact('farmers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('farmers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'village' => 'required',
        ]);

        Farmer::create($request->all());
        return redirect()->route('farmers.index')->with('success', 'Farmer added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Farmer $farmer)
    {
        return view('farmers.show', compact('farmer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Farmer $farmer)
    {
        return view('farmers.edit', compact('farmer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Farmer $farmer)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'village' => 'required',
        ]);

        $farmer->update($request->all());
        return redirect()->route('farmers.index')->with('success', 'Farmer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farmer $farmer)
    {
        $farmer->delete();
        return redirect()->route('farmers.index')->with('success', 'Farmer deleted successfully.');
    }
}
