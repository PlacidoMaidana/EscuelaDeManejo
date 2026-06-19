<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class eventosPorInstructor extends AbstractWidget
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
      

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-file-text',
            'title'  => "Gestión de Eventos por Instructor",
            'text'   => "Explora y modifica los eventos programados en el calendario, organizados por instructor.",
            'button' => [
                'text' => "Acceder al Calendario",
                'link' => route('calendario.modificar'),
            ],
           
            'image' => 'http://200.58.107.148/img/dream_TradingCard%20(4-2).jpg',
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
       return Auth::user()->can('browse', Voyager::model('Page'));
    }
}
