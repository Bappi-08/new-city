<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\OwnerEmail;
use Illuminate\Http\Request;
use App\Mail\SendOwnerEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;


class OwnerController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('backEnd.owners.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success', 'User has been added successfully.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'User has been updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User has been deleted successfully.');
    }
 
    
    public function sendEmail(Request $request, $id)
    {
        // Validate the email form
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Get the owner (assuming you have a User model)
        $owner = User::findOrFail($id);

        // Send email using the Mailable class
        Mail::to($owner->email)->send(new SendOwnerEmail($request->subject, $request->message));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Email sent successfully!');
    }
    

}
