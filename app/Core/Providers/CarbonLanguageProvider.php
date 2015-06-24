<?php

namespace ResultSystems\Emtudo\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class CarbonLanguageProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		Carbon::setLocale($this->app->getLocale());
	}

}
