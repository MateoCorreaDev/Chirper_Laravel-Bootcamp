<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;


class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chirps =  Chirp::with('user')
            ->latest()
            ->take(50)//limit to 50 mos recent chirps
            ->get();

        return view('home', ['chirps' => $chirps]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate the request

        $validated = $request->validate([
            'message' => "required|string|max:255"
        ]);

        //Create the chirp
        Chirp::create([
            'message' => $validated['message'],
        ]);

         return redirect('/')->with('success', 'Your Twi... CHIRP! has been posted!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //Retrun the view and sending the chirp model ROUTE MODEL BINDING
        return view('chirps.edit' , compact('chirp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //Validate the reques

        
        $validated = $request->validate([
            'message' => "required|string|max:255"
        ]);

        //Update the chirp
        $chirp->update($validated);

         return redirect('/')->with('success', 'Your Chirp has been updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //Delete the chirp

        $chirp->delete();

             return redirect('/')->with('success', 'Your Chirp has been deleted!');
    }
}
