<?php

class Home extends Controller
{
	public function index($name = '')
	{
		$this->view('_header');
		$this->view('_home');
		$this->view('_registration');
		$this->view('_footer');
	}
}
