<?php

namespace ResultSystems\Emtudo\Core\Http\Controllers;

use Auth;
use Illuminate\Routing\Controller;
use ResultSystems\Emtudo\Models\Usuarios;


class TestesController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Testes Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('testes');
	}

}
