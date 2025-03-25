<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArmorumappTipopeticion extends Model
{
    use HasFactory;


    // public function solicitudes()
    // {
    //     return $this->hasMany(ArmorumappSolicitud::class, 'armorumapp_tipopeticions', 'id');
    // }
    // public function solicitudes()
    // {
    //     return $this->belongsToMany(ArmorumappSolicitud::class, 'solicitud_tipopeticion', 'tipopeticion_id', 'solicitud_id');
    // }
    public function solicitudes()
    {
        return $this->belongsToMany(
            ArmorumappSolicitud::class,
            'solicitud_tipopeticion',
            'armorumapp_tipopeticion_id',
            'armorumapp_solicitud_id'
        );
    }
}
