<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\Plivo\PlivoChannel;
use NotificationChannels\Plivo\PlivoMessage;
use Illuminate\Notifications\Messages\MailMessage;

class activateSMS extends Notification
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
        return [PlivoChannel::class];
    }



    public function toPlivo($notifiable)
    {
        $message = "Thanks for signup at KOP! Please before you begin, you must confirm your account. Your Code is: " . $notifiable->activation_token;

        return (new PlivoMessage)
            ->content($message);
    }
}
