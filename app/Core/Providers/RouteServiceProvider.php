<?php

namespace ResultSystems\Emtudo\Core\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Config;
use ResultSystems\Emtudo\User\Models\User;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'ResultSystems\Emtudo\Core\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        $router->pattern('user', '[0-9]+');
        $router->bind('user', function($value) {
            return User::where('id',$value)
                ->limit(1)
                ->first();
        });
        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {

        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Core/Http/routes.php');
        });

        $router->group(['namespace' => 'ResultSystems\Emtudo\Admin'], function ($router) {
            require app_path('Admin/Http/routes.php');
        });

    }
}
