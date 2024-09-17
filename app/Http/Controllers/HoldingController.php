<?php

namespace App\Http\Controllers;

use App\Models\Holding;
use App\Models\District;
use Illuminate\Http\Request;
use App\Models\Building_Category;
use Illuminate\Support\Facades\Auth;

class HoldingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        $id=$user->id;
        $holding = Holding::where('user_id', $id)->with('Category', 'User')->get();
        $cat=Building_Category::CategoryOption();
        // $buildings = Building::with('Building_Categor')->get();
      
        // return $cat;
        return view ('frontEnd.new_pages.holding',\compact('id','holding','cat'));
        
    }
       public function address()
    {
        $districts = District::all();
        return view('frontEnd.new_pages.address', compact('districts'));
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
        $holding=new Holding();
        $user=Auth::user();
        $id=$user->id;
        $holding->holding=$request->holding;
        $holding->user_id=$id;
        // $holding->status=$request->status;
        $holding->name=$request->name;
        $holding->category_id=$request->category_id;
        $holding->save();
        return \redirect()->to('holding')->with ('success','successfully added');
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
       $holding=Holding::find($id);
       $user=Auth::user();
       $id=$user->id;
       $holding->holding=$request->holding;
       $holding->user_id=$id;
       $holding->category_id=$request->category_id;
    //    $holding->status=$request->status;
        $holding->name=$request->name;
       $holding->save();
      
        return \redirect()->to('holding')->with ('success','successfully added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Holding::find($id)->delete();
        return \redirect()->to('holding')->with ('success','successfully deleted');
    }
}
