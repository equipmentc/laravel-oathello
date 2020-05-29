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
        $encode = base64_encode(file_get_contents(__DIR__ .'/sample.pdf'));
        $data = [
            'envelope' => [
                "metadata" => "test-meta-data",
                'documents' => [[
                    'title'    => 'test',
                    'fileName' => 'test.pdf',
                    'mode'     => 'Signing',
                    'content'  => $encode,
                    "instructions" => [[
                        "userInputFields" => [[
                           "title" => "Add signature",
                           "type" => "signature",
                           "for" => "signer",
                           "region" => [
                               "pageNumber" => 1,
                               "x" => 260,
                               "y" => 395,
                               "width" => 120,
                               "height" => 20,
                               "isVisible" => true,
                            ],
                            "declarations" => []
                        ]],
                    ]],
                    "textFields" => [[
                       "content" => "[DATE]",
                       "region" => [
                           "pageNumber" => 1,
                           "x" => 280,
                           "y" => 735,
                           "width" => 60,
                           "height" => 10,
                           "isVisible" => true
                        ],
                        "fontSize" => 8,
                    ]],
                ]],
            ],
            'sessionStatusChangeCallbackUrl' => 'http://google.com',
            "sessionDocumentViewEnabled" => true,
            "sessionDocumentDownloadEnabled" => true
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

    /**
     * Can cancel a session.
     *
     * @return void
     */
    public function testCancelSession(): void
    {
        $this->assertEquals(
            $this->oathello->post('Session/'.$this->session->sessionId.'/cancel')->status,
            'cancelled'
        );
    }

    /**
     * Can add event to a session.
     *
     * @return void
     */
    public function testEvent(): void
    {
        $this->assertTrue(
            $this->oathello->post('Session/'.$this->session->sessionId.'/event', [
                'sessionId' => $this->session->sessionId,
                'sessionLogEvent' => 'SessionStatusChanged',
                'statusLabel' => 'Event Tested',
                'documentFingerprint' => $this->session->envelope->documents[0]->fingerprint
            ])
        );
    }

    /**
     * Can update a session ststus.
     *
     * @return void
     */
    public function testUpdateStatus(): void
    {
        $this->assertEquals(
            $this->oathello->post('Session/'.$this->session->sessionId.'/status/failed')->status,
            'failed'
        );
    }

    /**
     * Can cancel a session.
     *
     * @return void
     */
    public function testGetDocument(): void
    {
        $this->assertEquals(
            $this->oathello->get('Document/'.$this->session->envelope->documents[0]->fingerprint),
            200
        );
    }
}
