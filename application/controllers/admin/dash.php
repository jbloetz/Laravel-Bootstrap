<?php
class Admin_Dash_Controller extends Admin_Controller
{
    // Restful controllers allow us to prepend get_ or post_ to our function / url names
    // in order to logically separate the two types of request. Particularly useful
    // for CRUD systems.
    public $restful = true;

    public function get_index()
    {
        return View::make('admin.index',$this->data);
    }

    // Login Stuff
    public function get_login(){
    	return View::make('admin.login');
    }
    public function get_logout(){
    	Auth::logout();
		return Redirect::to('admin');
    }

    public function post_login(){
    	if (Auth::attempt(Input::get('username'), Input::get('password')))
		{
		     return Redirect::to('admin/dashboard');
		}else{
            return Redirect::to('admin/login');
        }
    }
    
}