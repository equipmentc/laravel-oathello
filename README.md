
# laravel-oathello
Oathello API Laravel package.  
Oathello is the Signing API built for the Finance Industry.

## Install
composer require equipmentc/laravel-oathello

## publish config
php artisan vendor:publish --tag=oathello

## add to .env
OATHELLO_ENDPOINT=https://sign.oathello.com/api/  (optional)  
OATHELLO_API_KEY=xyz  
OATHELLO_CALLBACK_URL=https://google.com

# HOW TO USE
There are two ways to use this package.  
The first is to use the Oathello Base Class to query the Oathello RESTful API directly.

### 1. Use the Oathello Base Class to query the Oathello RESTful API directly.

You can find the API Endpoints here [https://sign.oathello.com/swagger](https://sign.oathello.com/swagger)

```
use Equipmentc\Oathello\Oathello;

$oathello = new Oathello;
$oathello->get('Session/xyz');
$oathello->post('Session', $array);
```

#### Or use the facade
```
Oathello::get('Session/xyz');
Oathello::post('Session', $array);
```

### 2. For embedded documents you may only be concerned with envelopes and documents.

In this scenario you can use the helper classes to simplify the process.
Envelope is technically the session but in the majority of cases this isn't a problem as a session will contain only one envelope.

#### Create an envelope of one or more documents
```
$documents = [...];  (See a document array example below)
Envelope::create($documents);
```

#### Retrieve an envelope
```
Envelope::get($sessionId);
```

#### Cancel an envelope
```
Envelope::cancel($sessionId);
```

#### Document example usage
```
$document = Document::get($documentID);
Document::download($document);
```

## Testing
Add your own API key and callback url to the phpunit.xml file.

## Example Document
```
$documents = [[
    'title'    => 'Example',
    'fileName' => 'example.pdf',
    'mode'     => 'Signing',
    'content'  => '{YOUR_BASE64_ENCODED_DOCUMENT}',
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
```
