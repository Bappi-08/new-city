<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show(string $id)
    {
        $members = Member::where('apartment_id', $id)->get();
        return view('frontEnd.new_pages.member', compact('members', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $member = new Member();
        $member->nid = $request->nid;
        $member->name = $request->name;
        $member->email = $request->email;
        $member->date = $request->date;
        $member->profession = $request->profession;
        $member->cast = $request->cast;
        $member->marital = $request->marital;
        $member->language = $request->language;
        $member->blood = $request->blood;
        $member->religion = $request->religion;
        $member->nationality = $request->nationality;
        $member->gender = $request->gender;
        $member->age = $request->age;
        $member->phone = $request->phone;
        $member->apartment_id = $request->apartment_id;
        // return $member;
        $member->save();
        
        return redirect()->route('member.show', $request->apartment_id)->with('success', 'Member successfully added');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = Member::find($id);
        $member->nid = $request->nid;
        $member->name = $request->name;
        $member->email = $request->email;
        $member->date = $request->date;
        $member->profession = $request->profession;
        $member->cast = $request->cast;
        $member->marital = $request->marital;
        $member->language = $request->language;
        $member->blood = $request->blood;
        $member->religion = $request->religion;
        $member->nationality = $request->nationality;
        $member->gender = $request->gender;
        $member->age = $request->age;
        $member->phone = $request->phone;
        $member->apartment_id = $request->apartment_id;
        $member->save();

        return redirect()->route('member.show', $request->apartment_id)->with('success', 'Member successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::find($id);
        $apartment_id = $member->apartment_id;
        $member->delete();
        
        return redirect()->route('member.show', $apartment_id)->with('success', 'Member successfully deleted');
    }
    public function full_details(string $id)
    {   
        $members = Member::find($id);
            // return $full_details;
            // return $members;
         return view('frontEnd.new_pages.full_details',\compact('members'));

    }
}
