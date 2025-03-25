<?php

// namespace App\Notifications;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Messages\MailMessage;
// use Illuminate\Notifications\Notification;
// use App\Models\ArmorumappSolicitud;
// use App\Models\User;
// use Illuminate\Support\Facades\Storage;

// class SolicitudRecibida extends Notification
// {
//     use Queueable;

//     protected $solicitud;
//     protected $usuario;

//     /**
//      * Create a new notification instance.
//      */
//     public function __construct(ArmorumappSolicitud $solicitud, User $usuario)
//     {
//         $this->solicitud = $solicitud;
//         $this->usuario = $usuario;
//     }

//     /**
//      * Get the notification's delivery channels.
//      *
//      * @return array<int, string>
//      */
//     public function via(object $notifiable): array
//     {
//         return ['mail'];
//     }


//     /**
//      * Get the mail representation of the notification.
//      */
//     public function toMail(object $notifiable): MailMessage
//     {
//         $usuario = $this->usuario;
//         $solicitud = $this->solicitud;

//         return (new MailMessage)
//             ->subject('Recepción de Solicitud por Ventanilla Única')
//             ->greeting('POR FAVOR NO RESPONDA ESTE EMAIL, ESTA ES UNA NOTIFICACIÓN ELECTRÓNICA AUTOMÁTICA')
//             ->line('Se ha recepcionado a través de la Ventanilla Única Virtual una solicitud con los siguientes datos:')
//             ->line('Fecha de Solicitud: ' . now()->format('d-m-Y \a \l\a\s H:i:s'))
//             ->line('Nombre solicitante: ' . $usuario->primer_nombre . ' ' . $usuario->segundo_nombre . ' ' . $usuario->primer_apellido . ' ' . $usuario->segundo_apellido)
//             ->line('Identificación: ' . $usuario->documento_tercero)
//             ->line('Email: ' . $usuario->email)
//             ->line('Móvil: ' . $usuario->movil)
//             ->line('Dirección: ' . $usuario->direccion)
//             ->line('Ciudad: ' . $usuario->Municipios->municipio)
//             ->line('Tipo petición: ' . $solicitud->tipo_peticion)
//             ->line('Mensaje: ' . $solicitud->mensaje);
//     }




//     /**
//      * Get the array representation of the notification.
//      *
//      * @return array<string, mixed>
//      */
//     public function toArray(object $notifiable): array
//     {
//         return [
//             //
//         ];
//     }
// }
