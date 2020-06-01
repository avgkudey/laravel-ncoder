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
    Tetracode\Ncoder\NcoderBaseServiceProvider::class,
   ],
  ```
- #### Register Middleware

Add Ncoder middleware to routeMiddleware array in App/Http/Kernel.php

```php
 protected $routeMiddleware = [

 'ncoder'=>\Tetracode\Ncoder\Http\Middleware\EncryptHttp::class,
 'xncoder'=>\Tetracode\Ncoder\Http\Middleware\ForceEncryptHttp::class,
 ]
```
 - #### Publishing Config file
 ```bash
 php artisan vendor:publish --tag ncoder-config
``` 
- #### Generate Secret Key
 ```bash
 php artisan ncoder:secret
```

 ### Middleware Types
 
 **ncoder :** this will encrypt response only requested in front end.
 **xncoder :** this will encrypt response no matter requested in front end or not.

    

 ### Usage
 Route
 ```php
Route::middleware('ncoder')->post('api-endpoint', 'ApiController@store');

//Force Encrypt Response
Route::middleware('xncoder')->post('api-endpoint', 'ApiController@store');

Route::group(['middleware' => ['ncoder']], function () {
    Route::post('api-endpoint', 'ApiController@store');
});

//Force Encrypt Response
Route::group(['middleware' => ['xncoder']], function () {
    Route::post('api-endpoint', 'ApiController@store');
});
```   
Controller

```php
class UserController extends Controller {

    public function __construct() {
        $this->middleware(['ncoder']);
    }

    public function index() {
         return response()->json(User::all());
    }
}

```
OR

```php
class UserController extends Controller {

    public function __construct() {
        $this->middleware(['xncoder']);
    }

    public function index() {
        return response()->json(User::all());
    }
}
```

    