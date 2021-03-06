[![Latest Stable Version](https://poser.pugx.org/equipmentc/laravel-oathello/v)](//packagist.org/packages/equipmentc/laravel-oathello) [![Total Downloads](https://poser.pugx.org/equipmentc/laravel-oathello/downloads)](//packagist.org/packages/equipmentc/laravel-oathello) [![Latest Unstable Version](https://poser.pugx.org/equipmentc/laravel-oathello/v/unstable)](//packagist.org/packages/equipmentc/laravel-oathello) [![License](https://poser.pugx.org/equipmentc/laravel-oathello/license)](//packagist.org/packages/equipmentc/laravel-oathello)

# laravel-oathello
Oathello API Laravel package.  
[Oathello](https://www.oathello.com/oathello-sign) is the Signing API built for the Finance Industry.

## Install
composer require equipmentc/laravel-oathello

## publish config
php artisan vendor:publish --tag=oathello

## add to .env
OATHELLO_ENDPOINT=https://sign.oathello.com/api/  (optional)  
OATHELLO_API_KEY=xyz  
OATHELLO_CALLBACK_URL=https://xyz.tld

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

### 2. For embedded integrations you may only be concerned with documents.

In this scenario you can use the helper classes OathelloSession & Document to simplify the process.

#### Create a session of one or more (an envelope) documents
```
use Equipmentc\Oathello\Session as OathelloSession;

$documents = [...];  (See a document array example below)
$oathelloSession = new OathelloSession;
$oathelloSession->create($documents [, $metadata = null ]);

or the facade

$documents = [...];  (See a document array example below)
OathelloSession::create($documents [, $metadata = null ]);
```

#### Retrieve a session
```
$oathelloSession->get($sessionId);

or the facade

OathelloSession::get($sessionId);
```

#### Cancel a session
```
$oathelloSession->cancel($sessionId);

or the facade

OathelloSession::cancel($sessionId);
```

#### Document example usage
```
use Equipmentc\Oathello\Document;

$document = new Document;
$file = $document->get($documentID);
$document->download($file);

or the facade

$file = Document::get($documentID);
Document::download($file);
```

# HOW TO EMBED A DOCUMENT
```
@document(SESSION_ID, DOCUMENT_ID, SIGNER_ID (optional))
@onDocumentSigned
    // add your javascript without script tags
@endonDocumentSigned
@onSessionFinished
    // add your javascript without script tags
@endonSessionFinished
```

## Testing
Add your own API key and callback url to the phpunit.xml file.

## Example Document
```
$documents = [[
    'title'    => 'Example',
    'fileName' => 'example.pdf',
    'mode'     => 'Signing',
    'content'  => '{{YOUR_BASE64_ENCODED_DOCUMENT}}',
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
