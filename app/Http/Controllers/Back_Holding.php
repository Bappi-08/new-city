<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Holding;
use App\Models\District;
use Illuminate\Http\Request;
use App\Models\Building_Category;
use App\Models\LocationSelection;
use Illuminate\Support\Facades\Mail;
use App\Mail\HoldingApprovedMail;

class Back_Holding extends Controller
{
    public function index(string $id)
    {
        $holding = Holding::with('Category', 'floors', 'location')
        ->orderByRaw("FIELD(status, 'Pending', 'Approved', 'Declined')")
        ->orderBy('created_at', 'desc')
        ->paginate(5);
    

        $cat = Building_Category::CategoryOption();
    
        return view('backEnd.owners.holding', compact('id', 'holding', 'cat'));
    }
    
    
       public function address()
    {
        $districts = District::all();
        return view('frontEnd.new_pages.address', compact('districts'));
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
        return \redirect()->to('hold')->with ('success','successfully deleted');
    }
    public function generatePDF($id)
    {
        // Retrieve holding data with related category, floors, and owner
        $holding = Holding::with('Category', 'User', 'floors.apartments')->findOrFail($id);

        $locationSelection = LocationSelection::where('holding_id', $holding->id)->first();
        
        // Load data into the view to display in the PDF
        $pdf = new Mpdf();
        $pdf->ignore_invalid_utf8 = true;
        $pdf->autoScriptToLang = true;
        $pdf->autoVietnamese = true;
        $pdf->autoArabic = true;
        $pdf->autoLangToFont = true;
        $html = view('pdf.holding', compact('holding','locationSelection'))->render();
    
        // Write HTML content to PDF
        $pdf->WriteHTML($html);
    
        // Display the PDF in the browser for preview
        return $pdf->Output("Building_{$holding->holding}_Details.pdf", 'I');
    }
    
 
}
