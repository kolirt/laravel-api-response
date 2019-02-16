# Laravel Api Response v1.0.4

The package will help to generate json answers.

## Installation

```
composer require kolirt/laravel-api-response
```

## Example
Error response.
```php
return api()
        ->error()
        ->setCode(400) // default code 400

        ->setDescription(['Description #1', 'Description #2'])
        // or
        ->setDescription('Description')
        
        ->setData(['Data #1', 'Data #2'])
        // or
        ->setData('Data')
        
        ->render();
```

```php
[
    'ok' => false,
    'error_code' => 400
    
    'description' => ['Description #1', 'Description #2'],
    // or
    'description' => 'Description',
    
    'result' => ['Data #1', 'Data #2'],
    // or
    'result' => 'Data',
]
```

Success response.
```php
return api()
        ->success()
        ->setCode(200) // default code 200

        ->setDescription(['Description #1', 'Description #2'])
        // or
        ->setDescription('Description #1')
        
        ->setData(['Data #1', 'Data #2'])
        // or
        ->setData('Data')
        
        ->render();
```

```php
[
    'ok' => true,
    
    'description' => ['Description #1', 'Description #2'],
    // or
    'description' => 'Description',
    
    'result' => ['Data #1', 'Data #2'],
    // or
    'result' => 'Data',
]
```

## Methods

### error
Default response code 400.
```php
return api()->error();
```

### success
Default response code 200.
```php
return api()->success();
```

### setCode
Set custom response code. Available [codes](https://en.wikipedia.org/wiki/List_of_HTTP_status_codes).
```php
return api()->setCode($code);
```

### setDescription
Set description for response.
```php
return api()->setDescription(['Description #1', 'Description #2']);
// or
return api()->setDescription('Description');
```

### setData
Set data for response.
```php
return api()->setData(['Data #1', 'Data #2']);
// or
return api()->setData('Data');
```

### render
Render response.
```php
return api()->render();
```