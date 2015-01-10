<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
    
   protected $function_id = "home";

   public function __construct() {
       parent::__construct();
    }
    
    public function Index() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        return View::make('home/index', $this->data);
    }
    
	public function showWelcome()
	{
		return View::make('hello');
	}

}
