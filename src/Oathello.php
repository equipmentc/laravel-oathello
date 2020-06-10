<?php

namespace Equipmentc\Oathello;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Oathello
{
    protected $client;

    /**
     * Constructor
     *
     * Get config and and create new api
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client([
            'headers' => [ 'Content-Type' => 'application/json' ],
            'base_uri' => config('oathello.endpoint'),
            'auth'     => [config('oathello.api_key'), config('oathello.api_key')]
        ]);
    }

    /**
     * Overload methods
     *
     * @param  string $name Method
     * @param  array  $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        try {
            if (isset($arguments[1])) {
                $arguments[1] = ['json' => $arguments[1]];
            }
            $response = call_user_func_array([$this->client, $name], $arguments);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        }

        return json_decode(
            $response->getBody()->getContents()
        );
    }
}
