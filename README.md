# Laravel API Encryption Package


[![Total Downloads](https://poser.pugx.org/tetracode/ncoder/downloads)](https://packagist.org/packages/tetracode/ncoder)
[![Latest Stable Version](https://poser.pugx.org/tetracode/ncoder/v/stable)](https://packagist.org/packages/tetracode/ncoder)
[![Latest Unstable Version](https://poser.pugx.org/tetracode/ncoder/v/unstable)](https://packagist.org/packages/tetracode/ncoder)
[![License](https://poser.pugx.org/tetracode/ncoder/license)](https://packagist.org/packages/tetracode/ncoder)

Ncoder is a simple API call encryption middleware package designed to work on laravel Framework.

### Installing Ncoder

install trough [Composer](https://getcomposer.org/).

```bash
composer require tetracode/ncoder
```
### Configuration 

 - #### Register Service Provider
Above Laravel 5.5 or higher no need to add service provider
   
   if you are using laravel 5.4 or below add service provider to Config/app.php providers array
  
  ```php
 'providers' => [
    ...
    Tetracode\Ncoder\NcoderBaseServiceProvider::class,
   ],
  ```
- #### Register Middleware

Add Ncoder middleware to routeMiddleware array in App/Http/Kernel.php

```php
 protected $routeMiddleware = [
 ...
 'ncoder'=>\Tetracode\Ncoder\Http\Middleware\EncryptHttp::class,
 ]
```
 - #### Publishing Config file
 ```bash
 php artisan vendor:publish --tag ncoder-config
```

### Environment Setup
Add Environment variable to env file
   ```
NCODER_KEY=Your_base64_encryption_key
   ```
Eg : 
```
NCODER_KEY=base64:MBp8ntcfFJfdhHWInJ/lUwVtgNl4WNQY+h0Pin6B7WM=
```
 ### Usage
 Eg :
 ```php
Route::middleware('ncoder')->post('api-endpoint', 'ApiController@store');
```   
    
    
    