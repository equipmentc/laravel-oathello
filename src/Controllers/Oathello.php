<?php

namespace Equipmentc\Oathello\Controllers;

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
            'base_uri' => config('oathello.endpoint'),
            'auth'     => [config('oathello.key'), config('oathello.key')]
        ]);
    }

    /**
     * Overload methods
     *
     * @param  string $name Method
     * @param  array  $arguments
     * @return object
     */
    public function __call($name, array $arguments)
    {
        try {
            $response = call_user_func_array([$this->client, $name], $arguments);
        }
        catch (ClientException $e) {
            $response = $e->getResponse();
        }

        return json_decode(
            $response->getBody()->getContents()
        );
    }

    public function test()
    {
        dd('testing');
    }
}
