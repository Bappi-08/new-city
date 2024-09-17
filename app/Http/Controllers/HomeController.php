<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Building;
use App\Models\User_Detail;
use Illuminate\Http\Request;
use App\Models\Building_Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
class HomeController extends Controller
{
    public function home()
    {
        return view('frontEnd.pages.home');
    }
    public function second_home()
    {     $user = Auth::user();
        $userId = $user->id;
        return view('frontEnd.pages.second_home',\compact('userId'));

    }

    public function third_home()
    {   
        $holdings =\DB::table('holdings')->orderBy('holding','ASC')->get();
        $data['holdings'] = $holdings;
        return view('frontEnd.pages.third_home',$data);

    }
    
    // public function index(){
    //     $countries = \DB::table('countries')->orderBy('name','ASC')->get();
    //     $data['countries'] = $countries;
    //     return view('users.create',$data);
    // }

    public function fetchFloor($holding_id = null) {

        $floor = \DB::table('floors')->where('holding_id',$holding_id)->get();

        return response()->json([
            'status' => 1,
            'floors' => $floor
        ]);
    }

    public function fetchApartment($floor_id = null) {
        $apartment = \DB::table('apartments')->where('floor_id',$floor_id)->get();

        return response()->json([
            'status' => 1,
            'cities' => $apartment
        ]);
    }

    public function user_information()
    {     $user_detail = User_Detail::with('User','Buildings')->get();
   
        return view('frontEnd.pages.user_information',\compact('user_detail'));
    }
    public function details(string $id)
     {    
         $user_detail = User_Detail::with('User', 'Buildings')->find($id);
            
         return view('frontEnd.pages.details',\compact('user_detail'));
    }

    public function create()
    {
        $bappi= Building_Category::CategoryOption();
        return view('frontEnd.pages.create',\compact('bappi'));
    }
    public function data_store(Request $request)
    {
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
    //  dd($category);
      $category->save();
     // return $category;
      return \redirect()->to('/second_home')->with ('success','successfully added');
    }
    public function user_create()
    { 
        $aaa=Building::Bappi();
        $us=User::Us();
       // dd($bappi);
       return view('frontEnd.pages.user_create',\compact('aaa','us'));

    }
    public function user_store(Request $request)
    {   $category=new User_Detail();
        $category->nid=$request->nid;
        $category->date=$request->date;
        $category->profession=$request->profession;
        $category->cast=$request->cast;
        $category->marital=$request->marital;
        $category->language=$request->language;
        $category->blood=$request->blood;
        $category->religion=$request->religion;
        $category->nationality=$request->nationality;
        $category->gender=$request->blood;
        $category->age=$request->age;
        $category->passport=$request->passport;
        $category->building_id=$request->building_id;
        $category->user_id=$request->user_id;
       // return $category;
        $category->save();
        return \redirect()->to('second_home')->with ('success','successfully added');

    }
    public  function forth_home()
    {   

        $user = Auth::user();
        $userId = $user->id;
        // return $userId;
        // Assuming your model is named 'YourModel'
       $userId = User_Detail::where('user_id',  $userId)->value('id');

        return view('frontEnd.pages.forth_home',\compact('userId'));
    }
    public function bari_edit(string $id)
    {  
        
        
        $category=User_Detail::find($id);
        
        // $category = User_Detail::with('User','Buildings')->get();;
        // return $category;
        $bappi= Building::Bappi();
        // return $bappi;
        $us=User::Us();
        // return $us;
        return view('frontEnd.pages.bari_edit',\compact('category','bappi','us'));
    }
    public function user_update(Request $request, string $id)
    {       
        $category=User_Detail::find($id);
        // $category->building_id=$request->building_id;
        $category->nid=$request->nid;
        $category->date=$request->date;
        $category->profession=$request->profession;
        $category->cast=$request->cast;
        $category->marital=$request->marital;
        $category->language=$request->language;
        $category->blood=$request->blood;
        $category->religion=$request->religion;
        $category->nationality=$request->nationality;
        $category->gender=$request->blood;
        $category->age=$request->age;
        $category->passport=$request->passport;
        $category->building_id=$request->building_id;
        $category->user_id=$request->user_id;
     //    return $category;
       ///  return $category;
         $category->save();
         return \redirect()->to('second_home')->with ('success','successfully added');

    }

  

}
