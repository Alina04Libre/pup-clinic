<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Appointment;

class RescheduleAppointment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $appointment;
    protected $zoomLink;
    public function __construct(Appointment $appointment, $zoomLink)
    {
        //
        $this->appointment = $appointment;
        $this->zoomLink = $zoomLink;
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
        return (new MailMessage)
            ->subject('Appointment Status')
            ->markdown('email.rescheduledAppointment', ['appointment' => $this->appointment, 'zoomLink' => $this->zoomLink,]);
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
