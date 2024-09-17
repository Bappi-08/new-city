<?php
namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Thana;
use App\Models\Ward;
use App\Models\Moholla;
use App\Models\LocationSelection;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index($holding_id)
    {
        $districts = District::all();
        $locations = LocationSelection::where('holding_id',$holding_id)->get(); // Fetch all saved locations from the database
     
        return view('frontEnd.new_pages.address', compact('districts','holding_id','locations'));
    }

    public function getThanas($district_id)
    {
        $thanas = Thana::where('district_id', $district_id)->get();
        return response()->json($thanas);
    }

    public function getWards($zone_id)
    {
        $wards = Ward::where('zone_id', $zone_id)->get();
        return response()->json($wards);
    }

    public function getMohollas($ward_id)
    {
        $mohollas = Moholla::where('ward_id', $ward_id)->get();
        return response()->json($mohollas);
    }

    public function store(Request $request)
    {
        $locationSelection = new LocationSelection();
        $locationSelection->district_name = $request->district_name;
        $locationSelection->thana_name = $request->thana_name;
        $locationSelection->ward_name = $request->ward_name;
        $locationSelection->moholla_name = $request->moholla_name;
        $locationSelection->holding_id = $request->holding_id;
        $locationSelection->save();

        return redirect()->back()->with('success', 'Location saved successfully.');
    }

    public function edit($id)
    {
        $location = LocationSelection::find($id);
        $districts = District::all();
        return view('location.edit', compact('location', 'districts'));
    }

    public function update(Request $request, $id)
    {
        $locationSelection = LocationSelection::find($id);
        $locationSelection->district_name = $request->district_name;
        $locationSelection->thana_name = $request->thana_name;
        $locationSelection->ward_name = $request->ward_name;
        $locationSelection->moholla_name = $request->moholla_name;
        $locationSelection->save();

        return redirect()->back()->with('success', 'Location updated successfully.');
    }

    public function destroy($id)
    {
        $locationSelection = LocationSelection::find($id);
        $locationSelection->delete();

        return redirect()->back()->with('success', 'Location deleted successfully.');
    }
}
