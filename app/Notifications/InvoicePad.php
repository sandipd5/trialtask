<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvoicePad extends Notification
{
    use Queueable;

    
    public function __construct()
    {
        //
    }

   
    public function via($notifiable)
    {

        return $notifiable->prefers_sms ? ['nexmo'] : ['mail', 'database'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
                    
                    ->line('Welcome '.$this->my_notification)

                   ->action('Welcome ', url('https://laravel.com'))

                   ->line('Thank you for using our application!');
    }

   
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
