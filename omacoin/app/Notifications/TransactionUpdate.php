<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use App\Models\User;

class TransactionUpdate extends Notification
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
        $this->stage = ucwords(str_replace('_', ' ', $transaction->stage));
        $this->updated_by = User::find($transaction->updated_by)->email;

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
        $stage = $this->stage;
        $updatedBy = $this->updated_by;

        if($stage == 'Crypto Received') {
            $message = 'cryptocurrency has been confirmed';
            $user = 'an administrator';

        } else if($stage == 'Naira Sent') {
            $message = 'naira equivalent has been sent to the user';
            $user = 'an administrator';

        } else if($stage == 'Naira Received') {
            $message = 'naira equivalent has been confirmed';
            $user = 'the user';

        }

        
        return (new MailMessage)
                ->from('notifications@omacoin.com.ng', 'Omacoin Notifier')
                ->subject(Lang::get('Transaction Update - #' . strtoupper($ref) . ' [' . $stage . ']'))
                ->line(Lang::get('You are receiving this email because ' . $message . ' for transaction: #' . strtoupper($ref) . ' by ' . $user . ' [' . $updatedBy . '].'))
                ->action(Lang::get('Admin Panel'), url('/dashboard'));


        // return (new MailMessage)
        //             // ->subject('Omacoin | New Transaction')
        //             // ->greeting('Hello!')
        //             ->from('notifications@omacoin.com', 'Omacoin Notifier')
        //             // ->line("A new transaction has been created. Please login to the administrator's panel or click the button below to review");
        //             // ->action('ADMIN PANEL', url('/dashboard'))
        //             // ->line('Thank you for using our application!');


        //             ->subject(Lang::get('Transaction Update - #' . strtoupper($ref) . '['))
        //             ->line(Lang::get('You are receiving this email because a new transaction has been created.'))
        //             ->action(Lang::get('Admin Panel'), url('/dashboard'));
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
