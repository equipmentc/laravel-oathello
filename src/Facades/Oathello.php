<?php

namespace Equipmentc\Oathello\Facades;

use Illuminate\Support\Facades\Facade;

class Oathello extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Equipmentc\Oathello\Controllers\Oathello::class;
    }
}
