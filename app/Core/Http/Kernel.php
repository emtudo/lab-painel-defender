<?php

namespace ResultSystems\Emtudo\Core\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \ResultSystems\Emtudo\Core\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
     //   \ResultSystems\Emtudo\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \ResultSystems\Emtudo\Core\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \ResultSystems\Emtudo\Core\Http\Middleware\RedirectIfAuthenticated::class,
        'admin' => \ResultSystems\Emtudo\Core\Http\Middleware\Admin::class,
        'RoleOrPermission' => \ResultSystems\Emtudo\Core\Http\Middleware\RoleOrPermission::class,
        // Controle de acesso usando permissões
        'needsPermission' => \Artesaos\Defender\Middlewares\NeedsPermissionMiddleware::class,

        // Controle de acesso mais simples, utiliza apenas os grupos
        'needsRole' => \Artesaos\Defender\Middlewares\NeedsRoleMiddleware::class,
    ];
}
