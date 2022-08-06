<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
// use NotificationChannels\Plivo\PlivoChannel;
// use NotificationChannels\Plivo\PlivoMessage;
use Illuminate\Notifications\Messages\MailMessage;

class SignupActivate extends Notification
{
    use Queueable;

    /**
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct()
    {
        //
    }

    /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
    * Get the mail representation of the notification.
    *
    * @param  mixed  $notifiable
    * @return \Illuminate\Notifications\Messages\MailMessage
    */
    public function toMail($notifiable)
    {
        $url = url('/api/auth/activate/'.$notifiable->activation_token);

        return (new MailMessage)
            ->subject('Confirm your account')
            ->line('Thanks for signup! Please before you begin, you must confirm your account.')
            ->line('Your Code is: '. $notifiable->activation_token)
            // ->action('Confirm Account', url($url))
            ->line('Thank you for using our application!');
    }


    // public function toPlivo($notifiable)
    // {
    //     $message = "Thanks for signup! Please before you begin, you must confirm your account. Your Code is: ". $notifiable->activation_token;
    //     return (new PlivoMessage)
    //         ->content($message);
    // }
}
