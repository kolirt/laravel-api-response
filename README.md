<p align="center">
    <img src="https://raw.githubusercontent.com/kolirt/laravel-api-response/3e46d9c25ba6e7fd096ec57c668125cb2ab985ce/image.svg">
</p>

# Laravel Api Response

The package will help to generate json answers.

## Installation

```
$ composer require kolirt/laravel-api-response
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
    'error_code' => 400,
    
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
Set description to response.
```php
return api()->setDescription(['Description #1', 'Description #2']);
// or
return api()->setDescription('Description');
```

### setErrors
Set description to response.
```php
return api()->setErrors([
    'first_name' => 'Error message', 
    'last_name' => ['Error message 1', 'Error message 2']
]);
```

### abort
```php
return api()->abort('Error message', 400);
```

### cookie
Add cookie to response.
```php
return api()->cookie(cookie('token', 'asdsadsadas', 60 * 3));
```

### setData
Set data to response.
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