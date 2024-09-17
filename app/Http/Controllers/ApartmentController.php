<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Floor;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show(string $id)
    {
        $apartments = Apartment::where('floor_id', $id)->get();
        return view('frontEnd.new_pages.apartment', compact('apartments', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $apartment = new Apartment();
        $apartment->apartment = $request->apartment;
        $apartment->floor_id = $request->floor_id;
        $apartment->save();
        
        return redirect()->route('apartment.show', $request->floor_id)->with('success', 'Successfully added');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $apartment = Apartment::find($id);
        $apartment->apartment = $request->apartment;
        $apartment->floor_id = $request->floor_id;
        $apartment->save();

        return redirect()->route('apartment.show', $request->floor_id)->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $apartment = Apartment::find($id);
        $floor_id = $apartment->floor_id;
        $apartment->delete();
        
        return redirect()->route('apartment.show', $floor_id)->with('success', 'Successfully deleted');
    }
    public function getApartments($floor_id)
{
    $apartments = Apartment::where('floor_id', $floor_id)->get();
    return response()->json($apartments);
}

public function selectApartment(Request $request)
{
    // You can handle the selected apartment ID here
    $apartment_id = $request->input('apartment_id');
    
    // Redirect or return based on the selected apartment ID
    return redirect()->route('some.route')->with('apartment_id', $apartment_id);
}

}
