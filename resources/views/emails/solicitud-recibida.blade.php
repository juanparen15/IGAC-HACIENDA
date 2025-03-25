<x-mail::message>
    
    # POR FAVOR NO RESPONDA ESTE EMAIL, ESTA ES UNA NOTIFICACIÓN ELECTRÓNICA AUTOMÁTICA

    Se ha recepcionado a través de la plataforma IGAC tu solicitud de reclamo con los siguientes datos:

    - Fecha de Solicitud: {{ now()->format('d-m-Y \a \l\a\s H:i:s') }}
    - Nombre solicitante: {{ $usuario->primer_nombre }} {{ $usuario->segundo_nombre }} {{ $usuario->primer_apellido }} {{ $usuario->segundo_apellido }}
    - Identificación: {{ $usuario->username }}
    - Email: {{ $usuario->email }}
    - Número de Celular: {{ $usuario->movil }}
    - Dirección de Notificación: {{ $usuario->direccion }}
    - Ciudad: {{ $usuario->Municipios->municipio }}
    - Tipo de Reclamo: {{ is_array(json_decode($solicitud->tipo_peticion)) ? implode(', ', json_decode($solicitud->tipo_peticion)) : $solicitud->tipo_peticion }}
    - Mensaje: {!! $solicitud->mensaje !!}

    Saludos,
    {{ config('app.name') }}
</x-mail::message>
