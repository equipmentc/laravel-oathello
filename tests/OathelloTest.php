<?php

namespace Equipmentc\Oathello\Tests;

use PHPUnit\Framework\TestCase;
use Equipmentc\Oathello\Session;
use Equipmentc\Oathello\Document;

class OathelloTest extends TestCase
{
    /**
     * @var session
     */
    private $session;

    /**
     * @var document
     */
    private $document;

    /**
     * @var currentSession
     */
    private $currentSession;

    /**
     * Setup Client
     */
    protected function setUp(): void
    {
        $this->session  = new Session;
        $this->document = new Document;

        $documents = [[
            'title'    => 'test',
            'fileName' => 'test.pdf',
            'mode'     => 'Signing',
            'content'  => base64_encode(file_get_contents(__DIR__ . '/TestDoc001.pdf')),
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
        ]];

        $this->currentSession = $this->session->create($documents);
    }

    /**
     * Can create a session.
     *
     * @return void
     */
    public function testCreateSession(): void
    {
        $this->assertEquals($this->currentSession->status, 'ongoing');
    }

    /**
     * Can get a session.
     *
     * @return void
     */
    public function testGetSession(): void
    {
        $this->assertEquals(
            $this->session->get($this->currentSession->sessionId)->status,
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
            $this->session->cancel($this->currentSession->sessionId)->status,
            'cancelled'
        );
    }

    /**
     * Can retrieve a Document.
     *
     * @return void
     */
    public function testGetDocument(): void
    {
        $this->assertEquals(
            $this->document->get($this->currentSession->envelope->documents[0]->fingerprint)->getStatusCode(),
            200
        );
    }
}
