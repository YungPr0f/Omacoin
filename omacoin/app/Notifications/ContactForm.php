<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ContactForm extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        //
        $this->name = $request->name;
        $this->email = $request->email;
        $this->message = $request->message;
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
        $name = $this->name;
        $email = $this->email;
        $message = $this->message;

        return (new MailMessage)
                    ->from('notifications@omacoin.com.ng', 'Omacoin Notifier')

                    ->subject(Lang::get('Contact Form'))
                    ->line(Lang::get('You are receiving this email from the contact form available on the website. Please find details below: '))
                    ->line(Lang::get('Name: ' . $name))
                    ->line(Lang::get('Email: ' . $email))
                    ->line(Lang::get('Message: ' . $message));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
