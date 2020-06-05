<?php

namespace Equipmentc\Oathello;

use stdClass;

class Session extends Oathello
{
    /**
     * Create a new Session
     *
     * @param  array  $documents
     * @return mixed
     */
    public function create(array $documents): stdClass
    {
        $data = [
            'envelope' => [
                'documents' => $documents
            ],
            'sessionStatusChangeCallbackUrl' => config('oathello.callback_url'),
            "sessionDocumentViewEnabled" => true,
            "sessionDocumentDownloadEnabled" => true
        ];

        return Oathello::post('Session', $data);
    }

    /**
     * Fetch a Session
     *
     * @param  string   $sessionId
     * @return stdClass
     */
    public function get(string $sessionId): stdClass
    {
        return Oathello::get('Session/' . $sessionId);
    }

    /**
     * Cancel a new Session
     *
     * @param  string   $sessionId
     * @return stdClass
     */
    public function cancel(string $sessionId): stdClass
    {
        return Oathello::post('Session/' . $sessionId . '/cancel');
    }
}
