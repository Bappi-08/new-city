<?php
namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Building_Category;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Correct the relationship name
        $buildings = Building::with('buildingCategory')->get();
        return view('backEnd.pages.bari.index', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bappi = Building_Category::CategoryOption();
        return view('backEnd.pages.bari.create', compact('bappi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'name' => 'required',
            'owner' => 'required',
            'holding' => 'required',
            'flat' => 'required',
            'floor' => 'required',
            'address' => 'required',
            'building_id' => 'required',
        ]);

        // Save the building
        $building = new Building();
        $building->building_id = $request->building_id;
        $building->owner = $request->owner;
        $building->flat = $request->flat;
        $building->holding = $request->holding;
        $building->address = $request->address;
        $building->name = $request->name;
        $building->floor = $request->floor;
        $building->latitude = $request->latitude;
        $building->longitude = $request->longitude;
        $building->save();

        return redirect()->to('admin/Building')->with('success', 'Successfully added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Building::find($id);
        $bappi = Building_Category::CategoryOption();
        return view('backEnd.pages.bari.edit', compact('category', 'bappi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $this->validate($request, [
            'name' => 'required',
            'owner' => 'required',
            'holding' => 'required',
            'flat' => 'required',
            'floor' => 'required',
            'address' => 'required',
            'building_id' => 'required',
        ]);

        // Find and update the building
        $building = Building::find($id);
        $building->building_id = $request->building_id;
        $building->owner = $request->owner;
        $building->flat = $request->flat;
        $building->holding = $request->holding;
        $building->address = $request->address;
        $building->name = $request->name;
        $building->floor = $request->floor;
        $building->latitude = $request->latitude;
        $building->longitude = $request->longitude;
        $building->save();

        return redirect()->to('admin/Building')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Building::find($id)->delete();
        return redirect()->to('admin/Building')->with('success', 'Successfully deleted');
    }

    /**
     * Show the map for the specified building.
     */
    public function showMap($id)
    {
        $building = Building::findOrFail($id); // Fetch the building by ID
        return view('backEnd.pages.bari.map', compact('building'));
    }

    /**
     * Update the status of the specified building.
     */
    public function updateStatus(Request $request, $id)
    {
        $building = Building::findOrFail($id);
        $building->status = $request->status;
        $building->save();

        return redirect()->to('admin/Building')->with('success', 'Status updated successfully');
    }
}
