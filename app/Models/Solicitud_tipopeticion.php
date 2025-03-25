<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud_tipopeticion extends Model
{
    use HasFactory;

    protected $table = 'solicitud_tipopeticion';

    protected $fillable = ['solicitud_id', 'tipopeticion_id'];
}
