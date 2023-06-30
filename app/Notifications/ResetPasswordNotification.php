<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $url = url(config('app.url').route('password.reset', $this->token, false));

        return (new MailMessage)
            ->from(config('mail.from.address'), config('app.name'))
            ->greeting(Lang::get('passwords.reset_password_greeting') . ' ' . $notifiable->name . '!')
            ->subject(Lang::get('passwords.reset_password_notification'))
            ->line(Lang::get('passwords.reset_password_request'))
            ->action(Lang::get('passwords.reset_password_action'), $url)
            ->line(Lang::get('passwords.reset_password_expire', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
            ->line(Lang::get('passwords.no_action_required'))
            ->markdown('emails.custom-reset-password', ['subcopy' => Lang::get('passwords.reset_password_subcopy')]);
    }
}
