<?php

namespace Equipmentc\Oathello\Facades;

use Illuminate\Support\Facades\Facade;

class Session extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Equipmentc\Oathello\Session::class;
    }
}
