<?php

class Dashboard extends Controller {

	public function __construct()
	{
		global $config;
		$helper   = $this->loadHelper('Session_helper');
		$loggedIn = $helper->isLoggedInUser($config['session']['logged_in']);

		if(!$loggedIn)
			$helper->redirect($config['url']['login'] );

	}
	
	public function index()
	{
		$template = $this->loadView('dashboard');
		$template->set('title', 'Dashboard');
		$template->set('nav_dash', true);
		$template->render();
	}
    
}

?>
