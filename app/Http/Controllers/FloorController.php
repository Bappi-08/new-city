<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show(string $id)
    {
        
        $floor = Floor::where('holding_id', $id)->with('holding')->get();

       
        return view ('frontEnd.new_pages.floor',\compact('floor','id'));
        
    }

 
    /**
     * Show the form for creating a new resource.
     */
  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        // dd($request->all());
        $floor=new Floor();
       
        $floor->floor=$request->floor;
        $floor->holding_id=$request->holding_id;
        // $holding->status=$request->status;
        
        $floor->save();
        return redirect()->route('floor.show',$request->holding_id)->with('success', 'Successfully added');
    }
    

    /**
     * Display the specified resource.
 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // return $request->all();
        // dd($request->all());
       $floor=Floor::find($id);
       $floor->floor=$request->floor;
       $floor->holding_id=$request->holding_id;
       // $holding->status=$request->status;
       
       $floor->save();
       return redirect()->route('floor.show',$request->holding_id)->with('success', 'Successfully added');
     
      
     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   $floor=Floor::find($id);
        $holding_id=$floor->holding_id;
        Floor::find($id)->delete();
        return redirect()->route('floor.show',$holding_id)->with('success', 'Successfully added');
    }
}
