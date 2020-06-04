<?php

namespace Equipmentc\Oathello;

use GuzzleHttp\Psr7\Response;

class Document extends Oathello
{
    /**
     * Fetch a Document.
     *
     * @param  string   $documentId
     * @return Response
     */
    public function get(string $documentId): Response
    {
        return $this->client->get('Document/' . $documentId, [
            'sink' => tmpfile()
        ]);
    }

    /**
     * Download a Document.
     *
     * @param  string   $response
     * @return void
     */
    public function download(Response $response): void
    {
        header('Content-Type:' . $response->getHeader('Content-Type')[0]);
        header('Content-Disposition:' . $response->getHeader('Content-Disposition')[0]);

        echo $response->getBody()->getContents();
    }


}
