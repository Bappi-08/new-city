<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building_Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

class Building_Category_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
          $Building_Category=Building_Category::all();
        return view('backEnd.pages.building.index',\compact('Building_Category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backEnd.pages.building.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        // dd($request->all());
          $this->validate($request,['building_type'=>'required']);
        $category=new Building_Category();
        $category->building_type=$request->building_type;
      
        $category->save();
        return \redirect()->to('admin/Building_Category')->with ('success','successfully added');
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
    {   $category=Building_Category::find($id);
        return view('backEnd.pages.building.edit',\compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // return $request->all();
        // dd($request->all());
        $this->validate($request,['building_type'=>'required']);
        $category=Building_Category::find($id);
        $category->building_type=$request->building_type;
        $category->save();
        return \redirect()->to('admin/Building_Category')->with ('success','successfully added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Building_Category::find($id)->delete();
        return \redirect()->to('admin/Building_Category')->with ('success','successfully deleted');
    }
    public function profile()
    {   
        $user = Auth::user();
        // return $user;
        return view('backEnd.layouts.profile',\compact('user'));

    }
}
