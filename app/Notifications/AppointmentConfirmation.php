<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Appointment;

class AppointmentConfirmation extends Notification
{
    use Queueable;

    protected $appointment;
    protected $zoomLink;
    /**
     * Create a new notification instance.
     */
    public function __construct(Appointment $appointment, $zoomLink)
    {
        $this->appointment = $appointment;  // Store the appointment
        $this->zoomLink = $zoomLink; //For zoom link
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
            ->markdown('email.approvedAppointment', [
                'appointment' => $this->appointment, 
                'zoomLink' => $this->zoomLink,
            ]);
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
