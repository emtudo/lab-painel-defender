<?php

namespace ResultSystems\Emtudo\Core\Providers;

use ResultSystems\Emtudo\Domain\Providers\SendConfirmation as sendConfirmePagamentoToEmail;
use ResultSystems\Emtudo\Core\Validation\Validator as EmtudoValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(base_path('app/Admin/Permission/Resources/views'), 'permission');
        $this->loadViewsFrom(base_path('app/Person/Resources/views'), 'person');
        $this->loadViewsFrom(base_path('resources/views/auth'), 'auth');
        $this->loadViewsFrom(base_path('resources/views/admin'), 'admin');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'ResultSystems\Emtudo\Admin\Permission\Repositories\iGroupRepository',
            'ResultSystems\Emtudo\Admin\Permission\Repositories\GroupRepository'
        );
        $this->app->bind(
            'ResultSystems\Emtudo\Admin\Permission\Repositories\iPermissionRepository',
            'ResultSystems\Emtudo\Admin\Permission\Repositories\PermissionRepository'
        );
        $this->app->bind(
            'ResultSystems\Emtudo\User\Repositories\iUserRepository',
            'ResultSystems\Emtudo\User\Repositories\UserRepository'
        );
        $this->app->afterResolving('validator', function($validator){

            /** @var \Illuminate\Validation\Factory $validator */

            $validator->resolver(function($translator, $data, $rules, $messages, $customAttributes ){
                return new EmtudoValidator($translator, $data, $rules, $messages, $customAttributes);
            });

        });
    }
}
