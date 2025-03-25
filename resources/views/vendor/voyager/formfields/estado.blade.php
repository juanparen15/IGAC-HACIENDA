{{-- @php
    $estado = strtolower($data->estado ?? 'Desconocido');
    $color = '';

    switch ($estado) {
        case 'radicado':
            $color = 'yellow';
            break;
        case 'en proceso':
            $color = 'orange';
            break;
        case 'entregado':
            $color = 'green';
            break;
        case 'cancelado':
            $color = 'red';
            break;
        default:
            $color = 'grey';
            break;
    }

    // Verificar si el usuario autenticado es administrador
    $esAdmin = auth()->user()->hasRole('admin');

    // Verificar si estamos en la vista de edición/agregar o en la tabla (browse)
    $isEditOrAdd = isset($edit) || isset($add);
@endphp

@if ($isEditOrAdd && $esAdmin)
    <!-- Solo mostrar el select en la vista de edición o agregar -->
    <div style="display: flex; align-items: center;">
        <span
            style="display: inline-block; width: 15px; height: 15px; background-color: {{ $color }}; border-radius: 50%; margin-right: 10px;"></span>

        <select name="{{ $row->field }}" class="form-control">
            <option value="radicado" {{ $estado == 'radicado' ? 'selected' : '' }}>Radicado</option>
            <option value="en proceso" {{ $estado == 'en proceso' ? 'selected' : '' }}>En Proceso</option>
            <option value="entregado" {{ $estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
            <option value="cancelado" {{ $estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
        </select>
    </div>
@else
    <!-- En la tabla (browse) o si no es admin, solo mostrar el estado con color -->
    <span
        style="display: inline-block; width: 15px; height: 15px; background-color: {{ $color }}; border-radius: 50%; margin-right: 10px;"></span>
    {{ ucfirst($estado) }}
@endif --}}

{{-- @php
    // Obtener el estado actual del modelo
    $estado = strtolower($data->{$row->field} ?? 'Desconocido');
    $color = '';

    switch ($estado) {
        case 'radicado':
            $color = 'yellow';
            break;
        case 'en proceso':
            $color = 'orange';
            break;
        case 'entregado':
            $color = 'green';
            break;
        case 'cancelado':
            $color = 'red';
            break;
        default:
            $color = 'grey';
            break;
    }
@endphp

<div style="display: flex; align-items: center;">
    <!-- Círculo de color -->
    <span
        style="display: inline-block; width: 15px; height: 15px; background-color: {{ $color }}; border-radius: 50%; margin-right: 10px;"></span>

    <!-- Select para editar el estado -->
    <select name="{{ $row->field }}" class="form-control">
        <option value="radicado" {{ $estado == 'radicado' ? 'selected' : '' }}>Radicado</option>
        <option value="en proceso" {{ $estado == 'en proceso' ? 'selected' : '' }}>En Proceso</option>
        <option value="entregado" {{ $estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
        <option value="cancelado" {{ $estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
    </select>
</div> --}}

@php
    // $estado = strtolower($data->estado ?? 'Desconocido');
    // $estado = strtolower($data->{$row->field} ?? 'Desconocido');
    $estado = strtolower(old($row->field, $data->{$row->field} ?? 'Desconocido'));


    $color = '';

    switch ($estado) {
        case 'radicado':
            $color = 'yellow';
            break;
        case 'en proceso':
            $color = 'orange';
            break;
        case 'entregado':
            $color = 'green';
            break;
        case 'cancelado':
            $color = 'red';
            break;
        default:
            $color = 'grey';
            break;
    }

    // Verificar si el usuario autenticado es administrador
    $esAdmin = auth()->user()->hasRole('admin');

    // Verificar si estamos en la vista de edición/agregar o en la tabla (browse)
    $isEditOrAdd = isset($edit) || isset($add);
@endphp

@if ($isEditOrAdd && $esAdmin)
    <div style="display: flex; align-items: center;">
        <span
            style="display: inline-block; width: 15px; height: 15px; background-color: {{ $color }}; border-radius: 50%; margin-right: 10px;"></span>

        <select name="{{ $row->field }}" class="form-control">
            <option value="radicado" {{ $estado == 'radicado' ? 'selected' : '' }}>Radicado</option>
            <option value="en proceso" {{ $estado == 'en proceso' ? 'selected' : '' }}>En Proceso</option>
            <option value="entregado" {{ $estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
            <option value="cancelado" {{ $estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
        </select>
    </div>
@else
    <!-- Si NO es admin, mostrar solo el estado con el color -->
    <span
        style="display: inline-block; width: 15px; height: 15px; background-color: {{ $color }}; border-radius: 50%; margin-right: 10px;"></span>
    {{ ucfirst($estado) }}
@endif
