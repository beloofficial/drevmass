<?php

namespace App\Notifications;

use App\Models\Support;
use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class SupportFromClientNotification extends Notification
{
    /**
     * @var Support $support
     */
    protected Support $support;

    /**
     * @var User $client
     */
    protected User $client;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Support $support, User $client)
    {
        $this->support = $support;
        $this->client = $client;
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
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(config('mail.from.address'), config('app.name'))
            ->greeting(Lang::get('passwords.reset_password_greeting') . ' ' . $notifiable->name . '!')
            ->subject(Lang::get('support.subject'))
            ->line(Lang::get('support.email') . ' ' . $this->client->email)
            ->line(Lang::get('support.description'))
            ->line($this->support->problem_description)
            ->markdown('emails.support.admin_receiver');
    }
}
