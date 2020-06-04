<?php

return [

   /**
    * Endpoint
    */
   'endpoint' => env('OATHELLO_ENDPOINT', 'https://sign.oathello.com/api/'),

   /**
    * API access key
    */
   'api_key' => env('OATHELLO_API_KEY'),

   /**
    * Callback URL
    */
   'callback_url' => env('OATHELLO_CALLBACK_URL')

];
