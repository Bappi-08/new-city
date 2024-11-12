<?php

namespace App\Mail;


use App\Models\Holding;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HoldingApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $holding;

    public function __construct(Holding $holding)
    {
        $this->holding = $holding;
    }

    public function build()
    {
        return $this->view('emails.holdingApproved')
                    ->subject('Your Holding Has Been Approved')
                    ->with([
                        'holdingNumber' => $this->holding->holding,
                        'buildingName' => $this->holding->name,
                    ]);
    }
}
