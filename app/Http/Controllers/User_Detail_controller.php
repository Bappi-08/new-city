<?php

namespace App\Http\Controllers;
use App\Models\Building_Category;
use App\Models\Building;
use App\Models\User;
use App\Models\User_Detail;
use Illuminate\Http\Request;

class User_Detail_controller extends Controller
{
    
    public function index()
    {   
          $user_detail = User_Detail::with('User','Buildings')->get();
        
        return view('backEnd.pages.user_detail.index',\compact('user_detail'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
     {  
        //  return 'dfdf';
         $aaa=Building::Bappi();
          $us=User::Us();
        // // dd($bappi);
        // return $us;
        return view('backEnd.pages.user_detail.create',\compact('aaa','us'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     //  return $request->all();
       //  dd($request->all());
        //   $this->validate($request,
        //   [ 'name'=>'required',
        //     'owner'=>'required',
        //     'holding'=>'required',
        //     'flat'=>'required',
        //     'floor'=>'required',
        //     'address'=>'required',
        //     'building_id'=>'required'
            
        // ]);
        $category=new User_Detail();
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
        return \redirect()->to('admin/User_Detail')->with ('success','successfully added');
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
    {   

        $category=User_Detail::find($id);
        
        // $category = User_Detail::with('User','Buildings')->get();;
        // return $category;
        $bappi= Building::Bappi();
        // return $bappi;
        $us=User::Us();
        // return $us;
        return view('backEnd.pages.user_detail.edit',\compact('category','bappi','us'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // return $request->all();
        // dd($request->all());
      //  $this->validate($request,['building_type'=>'required']);
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
        return \redirect()->to('admin/User_Detail')->with ('success','successfully added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {  // return $id;
        User_Detail::find($id)->delete();
        return \redirect()->to('admin/Building')->with ('success','successfully deleted');
    }

    public function user_details(string $id)
    {
        $user = User_Detail::with('User', 'Buildings')->find($id);
        // return $user_detail;
        return view('backEnd.pages.user_detail.user_details',\compact('user'));


    }
    public function updateStatus(Request $request, $id)
{
    $userDetail = User_Detail::findOrFail($id);
    $userDetail->status = $request->status;
    $userDetail->save();

    return \redirect()->to('admin/User_Detail')->with ('success','successfully added');
}

}
