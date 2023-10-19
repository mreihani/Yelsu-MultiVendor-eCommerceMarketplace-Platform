<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Channels\SmsChannelUserAuth;
use Illuminate\Notifications\Messages\MailMessage;

class UserAuthNotification extends Notification
{
    use Queueable;

    public $userinfo;

    /**
     * Create a new notification instance.
     */
    public function __construct($userinfo)
    {
        $this->userinfo = $userinfo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail'];
        return [SmsChannelUserAuth::class];
    }

    public function toFarazSms($notifiable) {
        return[
            "userinfo" => $this->userinfo,
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
