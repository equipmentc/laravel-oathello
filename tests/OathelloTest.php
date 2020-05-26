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

    /**
     * @var session
     */
    private $session;

    /**
     * Setup Client
     */
    protected function setUp(): void
    {
        $this->oathello = new Oathello;
    }

    /**
     * Can create a session.
     *
     * @return void
     */
    public function testCreateSession(): void
    {
        print_r($this->oathello->post('Session'));
    }

    /**
     * Can get a session.
     *
     * @return void
     */
    public function testGetSession(): void
    {
        $this->assertEquals(
            $this->oathello->get('Session/ebbdadbc-f6f5-4ef7-9aa3-0df1ca0eb230')->status,
            'finished'
        );
    }
}
