# laravel-oathello
Oathello API Laravel package

## Install
composer require equipmentc/laravel-oathello

## publish config
php artisan vendor:publish --tag=oathello

## add to .env
OATHELLO_ENDPOINT=https://sign.oathello.com/api/  (optional)  
OATHELLO_API_KEY=xyz

## To use
```
use Equipmentc\Oathello\Controllers\Oathello;

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

## Swagger endpoints
[https://sign.oathello.com/swagger](https://sign.oathello.com/swagger)
