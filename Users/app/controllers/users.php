<?php

class Users extends Controller
{
	public function index($name = '')
	{
		$user = $this->model('user');
		$user->name = $name;
		
		$this->view('_header');
		// $this->view('_user',['name' => $user->name]);
		$this->view('_navbar');
		$this->view('_profile');
		$this->view('_Jobs');
		
		$this->view('_footer');	
	}
}