<?php

namespace App\Notifications;

use App\Models\Support;
use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class SupportFromAdminNotification extends Notification
{
    /**
     * @var Support $support
     */
    protected Support $support;

    /**
     * @var User $client
     */
    protected User $admin;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Support $support, User $admin)
    {
        $this->support = $support;
        $this->admin = $admin;
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
            ->line(Lang::get('support.subject') . '.')
            ->line(Lang::get('support.your_description'))
            ->line($this->support->problem_description)
            ->line(Lang::get('support.answer'))
            ->line($this->support->answer_description)
            ->line(Lang::get('support.thanks'))
            ->markdown('emails.support.admin_receiver')
            ->with(['salutation' => Lang::get('email.Regards'), 'name' => config('app.name')]);
    }
}
