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
    public $session;

    /**
     * Setup Client
     */
    protected function setUp(): void
    {
        $this->oathello = new Oathello;
        $data = [
            'envelope' => [
                'documents' => [[
                    'title'    => 'test',
                    'fileName' => 'test.pdf',
                    'mode'     => 'Reading',
                    'content'  => 'dGVzdA=='
                ]]
            ],
            'sessionStatusChangeCallbackUrl' => 'test'
        ];
        $this->session = $this->oathello->post('Session', $data);
    }

    /**
     * Can create a session.
     *
     * @return void
     */
    public function testCreateSession(): void
    {
        $this->assertEquals($this->session->status, 'ongoing');
    }

    /**
     * Can get a session.
     *
     * @return void
     */
    public function testGetSession(): void
    {
        $this->assertEquals(
            $this->oathello->get('Session/'.$this->session->sessionId)->status,
            'ongoing'
        );
    }
}
