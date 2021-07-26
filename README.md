# lumen-roadrunner

---

Easy way for connecting RoadRunner and Lumen^6.x applications.


## usage

---

1. Require package

`composer require qeezer/lumen-roadrunner`


2. Add provider to `bootstrap/app.php`

```
/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// add provider
$app->register(\QeeZer\LumenRoadRunner\Providers\LumenServiceProvider::class);
// $app->register(App\Providers\AppServiceProvider::class);
// $app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);
```


3. Copy the rr config file to base directory.

>  [The config file docs.](https://roadrunner.dev/docs/intro-config)

`cp ./vendor/qeezer/lumen-roadrunner/config/.rr.yaml ./`


4. Download rr binary file.

`./vendor/bin/rr get`


4. Run it.

`./rr serve`


## The Laravel's roadrunner

---

> https://github.com/spiral/roadrunner-laravel


## Warning

--- 

Please see https://github.com/spiral/roadrunner-laravel/blob/master/README.md to learn.