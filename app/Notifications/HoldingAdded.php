<?php

namespace App\Notifications;


use App\Models\Holding;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HoldingAdded extends Notification
{
    use Queueable;

    public $holding;
    public $userId; // Add userId property

    public function __construct(Holding $holding, $userId)
    {
        $this->holding = $holding;
        $this->userId = $userId; // Set userId
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'user_name' => $notifiable->name,
            'holding_name' => $this->holding->name,
            'holding_id' => $this->holding->id,
            'user_id' => $this->userId, // Add user_id here
            'message' => 'A new holding has been added by ' . $notifiable->name,
        ];
    }
}
