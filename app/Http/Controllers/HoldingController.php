<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use App\Models\Holding;
use App\Models\District;
use Illuminate\Http\Request;
use App\Mail\HoldingApprovedMail;
use App\Models\Building_Category;
use App\Notifications\HoldingAdded;
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
        $holding = Holding::where('user_id', $id)->with('Category', 'User','floors')->get();
        $cat=Building_Category::CategoryOption();
        // return $holding;
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
        $holding = new Holding();
        $user = Auth::user();
        $id = $user->id;
    
        $holding->holding = $request->holding;
        $holding->user_id = $id;
        $holding->name = $request->name;
        $holding->category_id = $request->category_id;
        $holding->save();
    
        // Send notification
        $user->notify(new HoldingAdded($holding, $id)); // Pass user_id
    
        return redirect()->to('holding')->with('success', 'Successfully added');
    }
    
    public function update(Request $request, string $id)
    {
        $holding = Holding::find($id);
        $user = Auth::user();
        $userId = $user->id;
        
        $holding->holding = $request->holding;
        $holding->user_id = $userId;
        $holding->category_id = $request->category_id;
        $holding->name = $request->name;
        $holding->save();
    
        // Notify the user if needed
        $user->notify(new HoldingAdded($holding, $userId)); // Pass user_id
    
        return redirect()->to('holding')->with('success', 'Successfully updated');
    }
    
    /**
     * Display the specified resource.
 

    /**
     * Update the specified resource in storage.
     */
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Holding::find($id)->delete();
        return redirect()->back()->with('success', 'Successfully deleted');
    }
    
    
    public function updateStatus(Request $request, $id)
    {
        $holding = Holding::findOrFail($id);
        $holding->status = $request->input('status');
        $holding->save();
    
        // Check if the status is approved, then send an email
        if ($holding->status == 'Approved') {
            Mail::to($holding->User->email)->send(new HoldingApprovedMail($holding));
        }
    
        return redirect()->back()->with('success', 'Status updated successfully.');
    }
    

}
