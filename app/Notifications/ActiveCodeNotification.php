<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Notifications\Channels\SmsChannel;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ActiveCodeNotification extends Notification
{
    use Queueable;

    public $code;
    public $phoneNumber;

    /**
     * Create a new notification instance.
     */
    public function __construct($code, $phoneNumber)
    {
        $this->code = $code;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [SmsChannel::class];
    }

    public function toFarazSms($notifiable) {
        return[
            "text" => $this->code,
            "number" => $this->phoneNumber
        ];
    }    

   
}
