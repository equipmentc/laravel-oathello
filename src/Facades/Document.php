<?php

namespace Equipmentc\Oathello\Facades;

use Illuminate\Support\Facades\Facade;

class Document extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Equipmentc\Oathello\Document::class;
    }
}
