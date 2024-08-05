<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Appointment;
use App\Models\User;

class NewAppointment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $appointment;
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $superadmins = User::role('superadmin')->get();

        $mailMessage = (new MailMessage)
            ->subject('New Appointment')
            ->markdown('email.newAppointment', [
                'appointment' => $this->appointment, 
            ]);

            foreach ($superadmins as $superadmin) {
                $mailMessage->bcc($superadmin->email);
            }
    
            return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
