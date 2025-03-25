<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ArmorumappRadicado;
use Carbon\Carbon;

class DescontarDiasHabiles extends Command
{
    protected $signature = 'radicados:descontar-dias';
    protected $description = 'Descuenta un día hábil de los tickets registrados';

    public function handle()
    {
        $hoy = Carbon::now();

        // Verificar si hoy es un día hábil (lunes a viernes, sin contar festivos)
        if (!$hoy->isWeekday()) {
            $this->info('Hoy no es un día hábil. No se descontarán días.');
            return;
        }

        // Obtener los tickets que aún tienen días hábiles restantes
        $tickets = ArmorumappRadicado::where('fecha_respuesta', 'LIKE', '%Días Hábiles%')->get();

        foreach ($tickets as $ticket) {
            // Extraer el número de días restantes
            preg_match('/(\d+)/', $ticket->fecha_respuesta, $matches);
            $diasRestantes = isset($matches[1]) ? (int)$matches[1] : 0;

            // Si aún hay días hábiles restantes, restar uno
            if ($diasRestantes > 0) {
                $nuevoDiasRestantes = max($diasRestantes - 1, 0);
                $ticket->fecha_respuesta = "{$nuevoDiasRestantes} Días Hábiles";
                $ticket->save();
            }
        }

        $this->info('Días hábiles actualizados correctamente.');
    }
}
