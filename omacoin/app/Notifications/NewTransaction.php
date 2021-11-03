<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class NewTransaction extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($transaction)
    {
        //
        $this->ref = $transaction->ref;
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
        $ref = $this->ref;

        return (new MailMessage)
                    // ->subject('Omacoin | New Transaction')
                    // ->greeting('Hello!')
                    ->from('notifications@omacoin.com.ng', 'Omacoin Notifier')
                    // ->line("A new transaction has been created. Please login to the administrator's panel or click the button below to review");
                    // ->action('ADMIN PANEL', url('/dashboard'))
                    // ->line('Thank you for using our application!');


                    ->subject(Lang::get('New Transaction - #' . strtoupper($ref)))
                    ->line(Lang::get('You are receiving this email because a new transaction has been created.'))
                    ->action(Lang::get('Admin Panel'), url('/dashboard'));
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
