<?php

class Auth extends Controller {

	private $session_helper;

	function __construct() {
		$this->session_helper = $this->loadHelper('Session_helper');
	}
	
	public function index()
	{
		global $config;
		$loggedIn = $this->session_helper->isLoggedInUser($config['session']['logged_in']);

		if(!$loggedIn)
			$this->previewLogin();
		else
			$this->session_helper->redirect($config['url']['dashboard']);

	}

	private function previewLogin(){

		global $config;
		$template = $this->loadView('login');
		$template->set('title', $config['app_cofig']['name']);		
		$template->set('action', 'auth/login/');		
		$template->set('method', 'post');		
		$template->render();

	}

	/**
	 * public 
	 * http : post
	 * @return null
	 */
	public function login()
	{

		$param  = $_REQUEST;

		$model 	= $this->loadModel('Auth_model');
		$data 	= $model->login($param);

		$this->session_helper->setLoggedInUser($data);		
	}

	/**
	 * public 
	 * http : get
	 * @return null
	 */
	public function logout()
	{
		$this->session_helper->destroy();
	}
    
}

