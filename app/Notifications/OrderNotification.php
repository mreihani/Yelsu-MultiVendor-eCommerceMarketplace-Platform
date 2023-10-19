<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Notifications\Channels\SmsChannelOrder;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderNotification extends Notification
{
    use Queueable;

    public $userinfo;
    public $orderid;

    /**
     * Create a new notification instance.
     */
    public function __construct($userinfo, $orderid)
    {
        $this->userinfo = $userinfo;
        $this->orderid = $orderid;
    }

   
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail'];
        return [SmsChannelOrder::class];
    }

    public function toFarazSms($notifiable) {
        return[
            "userinfo" => $this->userinfo,
            "orderid" => $this->orderid
        ];
    }    


    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
}
