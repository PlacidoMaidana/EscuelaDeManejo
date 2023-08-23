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
            'title'  => "Mi primer widget",
            'text'   => "Este es un texto que ira en el widget",
            'button' => [
                'text' => "Titulo del enlace",
                'link' => route('calendario.modificar'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/03.jpg'),
            'image' => 'img/dream_TradingCard (4-2).jpg',
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
