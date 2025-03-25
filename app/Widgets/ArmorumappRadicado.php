<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class ArmorumappRadicado extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $user = Auth::user();
        
        // Verificar si el usuario es administrador
        $isAdmin = $user->hasRole('admin');

        if ($isAdmin) {
            $count = \App\Models\ArmorumappRadicado::count();
        } else {
            // Contar solo los registros del usuario actual
            $count = \App\Models\ArmorumappRadicado::where('usuario', $user->id)->count();
        }
        
        $string = $count > 1 ? 'Tickets' : 'Ticket';
        $text = "Tiene {$count} {$string} en su base de datos. Haga clic en el botón de abajo para ver todas las {$string}.";

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-receipt',
            'title'  => "{$count} {$string}",
            'text'   => "{$text}",
            'button' => [
                'text' => 'Ver ' . $string,
                'link' => route('voyager.igac-radicado.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', new \App\Models\ArmorumappRadicado);


    }
}
