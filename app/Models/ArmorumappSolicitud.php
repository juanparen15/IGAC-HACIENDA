<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class ArmorumappSolicitud extends Model
{
    use HasFactory;
    protected $table = 'armorumapp_solicitud';
    protected $primaryKey = 'id'; // Si la clave primaria es 'id'
    // protected $casts = [
    //     'tipo_peticion' => 'array',
    // ];

    protected $fillable = ['documento_tercero',];

    public function scopeCurrentUser($query)
    {
        if (Auth::user()->role_id == 2) {
            // $this->documento_tercero = Auth::user()->username;
            return $query->where('documento_tercero', Auth::user()->username);
        } else {
            // Si el usuario no está autenticado o su role_id no es igual a 2, retornamos una consulta vacía
            // return $query->where('id', '=', null);
        }
    }

    protected static function boot()
    {
        parent::boot();

        // Utiliza el evento creating para establecer el campo documento_tercero
        static::creating(function ($solicitud) {
            // Verifica si hay un usuario autenticado
            if (Auth::check()) {
                // Establece el valor del campo documento_tercero como el nombre de usuario del usuario autenticado
                $solicitud->documento_tercero = Auth::user()->username;
                $solicitud->user_id = Auth::user()->id;
            }
        });
    }

    public function radicado()
    {
        return $this->belongsTo(ArmorumappRadicado::class, 'estado', 'id'); // 'estado' es el campo en la tabla 'solicitud' que hace referencia a la tabla 'radicado'
    }

    public function tipopeticions()
    {
        return $this->belongsToMany(
            ArmorumappTipopeticion::class,
            'solicitud_tipopeticion',
            'armorumapp_solicitud_id', 
            'armorumapp_tipopeticion_id'
        )->withPivot('solicitud_id'); 
    }
}
