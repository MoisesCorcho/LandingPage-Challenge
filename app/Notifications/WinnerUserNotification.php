<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WinnerUserNotification extends Notification
{
    use Queueable;

    private $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        $name = $this->user->name;
        return (new MailMessage)
                    ->line("¡Felicidades! $name")
                    ->line('Eres el afortunado ganador del Gran Concurso de Autos.')
                    ->line('Disfruta de tu premio y no dudes en ponerte en contacto con nosotros si tienes alguna pregunta.')
                    ->line('Gracias por participar en nuestro concurso y por ser parte de nuestra comunidad.')
                    ->line('¡Que tengas un excelente día!')
                    ->action('Visita nuestra pagina', route('landingPage.index'));

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
