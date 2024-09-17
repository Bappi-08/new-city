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
          $buildings = Building::with('Building_Categor')->get();
        return view('backEnd.pages.bari.index',\compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $bappi= Building_Category::CategoryOption();
        // dd($bappi);
        return view('backEnd.pages.bari.create',\compact('bappi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //  return $request->all();
       //  dd($request->all());
          $this->validate($request,
          [ 'name'=>'required',
            'owner'=>'required',
            'holding'=>'required',
            'flat'=>'required',
            'floor'=>'required',
            'address'=>'required',
            'building_id'=>'required'
            
        ]);
        $category=new Building();
        $category->building_id=$request->building_id;
        $category->owner=$request->owner;
        $category->flat=$request->flat;
        $category->holding=$request->holding;
        $category->address=$request->address;
        $category->name=$request->name;
        $category->floor=$request->floor;
        $category->latitude=$request->latitude;
        $category->longitude=$request->longitude;
       // return $category;
        $category->save();
        return \redirect()->to('admin/Building')->with ('success','successfully added');
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
    public function edit(string $id)
    {   $category=Building::find($id);
        $bappi= Building_Category::CategoryOption();
        return view('backEnd.pages.bari.edit',\compact('category','bappi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // return $request->all();
        // dd($request->all());
      //  $this->validate($request,['building_type'=>'required']);
        $category=Building::find($id);
       // $category->building_id=$request->building_id;
        $category->owner=$request->owner;
        $category->flat=$request->flat;
        $category->holding=$request->holding;
        $category->address=$request->address;
        $category->name=$request->name;
        $category->floor=$request->floor;
        $category->building_id=$request->building_id;
        $category->latitude=$request->latitude;
        $category->longitude=$request->longitude;
       // return $category;
      ///  return $category;
        $category->save();
        return \redirect()->to('admin/Building')->with ('success','successfully added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {  // return $id;
        Building::find($id)->delete();
        return \redirect()->to('admin/Building')->with ('success','successfully deleted');
    }
    public function showMap($id)
    {
        $building = Building::findOrFail($id); // Fetch the building by ID
        return view('backEnd.pages.bari.map', compact('building'));
    }
    public function updateStatus(Request $request, $id):
    {
        $userDetail = Building::findOrFail($id);
        $userDetail->status = $request->status;
        $userDetail->save();
    
        return \redirect()->to('admin/Building')->with ('success','successfully added');
    }
    

}
