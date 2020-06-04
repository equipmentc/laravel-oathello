# laravel-oathello
Oathello API Laravel package
Oathello is the Signing API built for the Finance Industry.

## Install
composer require equipmentc/laravel-oathello

## publish config
php artisan vendor:publish --tag=oathello

## add to .env
OATHELLO_ENDPOINT=https://sign.oathello.com/api/  (optional)  
OATHELLO_API_KEY=xyz
OATHELLO_CALLBACK_URL=https://google.com

## Create an envelope of one or more documents
```
$documents = [...];
Envelope::create($documents);
```

## Retrieve an envelope
```
Envelope::get($sessionId);
```

## Cancel an envelope
```
Envelope::cancel($sessionId);
```

## Document example usage
```
$document = Document::get($documentID);
Document::download($document);
```

## Or use the base class directly to query the restful api
```
use Equipmentc\Oathello\Oathello;

$oathello = new Oathello;
$oathello->get('Session/xyz');
$oathello->post('Session', $array);
```

## Or use the facade
```
Oathello::get('Session/xyz');
Oathello::post('Session', $array);
```

## Swagger endpoints
[https://sign.oathello.com/swagger](https://sign.oathello.com/swagger)

## Testing
Add your own API key and callback url to the phpunit.xml file.
