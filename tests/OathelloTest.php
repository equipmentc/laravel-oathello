<?php

namespace Equipmentc\Oathello;

use PHPUnit\Framework\TestCase;
use Equipmentc\Oathello\Controllers\Oathello;

class OathelloTest extends TestCase
{
    /**
     * @var oathello
     */
    private $oathello;

    protected function setUp(): void
    {
        $this->oathello = new Oathello;
    }
}
