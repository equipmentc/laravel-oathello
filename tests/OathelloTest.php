<?php

namespace Equipmentc\Oathello\Tests;

use PHPUnit\Framework\TestCase;
use Equipmentc\Oathello\Envelope;
use Equipmentc\Oathello\Document;

class OathelloTest extends TestCase
{
    /**
     * @var envelope
     */
    private $envelope;

    /**
     * @var document
     */
    private $document;

    /**
     * @var session
     */
    public $session;

    /**
     * Setup Client
     */
    protected function setUp(): void
    {
        $this->envelope = new Envelope;
        $this->document = new Document;

        $documents = [[
            'title'    => 'test',
            'fileName' => 'test.pdf',
            'mode'     => 'Signing',
            'content'  => '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',
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

        $this->session = $this->envelope->create($documents);
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
            $this->envelope->get($this->session->sessionId)->status,
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
            $this->envelope->cancel($this->session->sessionId)->status,
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
            $this->document->get($this->session->envelope->documents[0]->fingerprint)->getStatusCode(),
            200
        );
    }
}
