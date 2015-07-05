<?php namespace App\Http\Controllers\admin;

use App\Http\Controllers\MyBaseController as MyBaseController;

class AdminController extends MyBaseController {


	public function __construct()
	{
		//$this->middleware('guest');
	}


	public function index()
	{
		return view('admin.index');
	}

}
