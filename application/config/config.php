<?php 

define('ENV', isset($_SERVER['PIP_ENV']) ? $_SERVER['PIP_ENV'] : 'dev');

/**
 * Error reporting
 * 
 */
switch (ENV)
{
	case 'dev':
		error_reporting(E_ALL);
	break;

	case 'qa':
	case 'prod':
		error_reporting(0);
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit;
}

$config['default_controller']	= 'dashboard'; // Default controller to load
$config['error_controller']		= 'error'; // Controller used for errors (e.g. 404, 500 etc)

$config['base_url'] = 'http://localhost/app/';
$config['app_cofig']['name']  = 'harithakeralam';
$config['app_cofig']['database']['host']    	= 'localhost';
$config['app_cofig']['database']['name']    	= 'h_k_app';
$config['app_cofig']['database']['username']    = 'root';
$config['app_cofig']['database']['password']	= '';

/*
| -------------------------------------------------------------------
|  session structure
| -------------------------------------------------------------------
| logged_in   => true or false,
| logged_user => array (
|					id => 1,
|					username => 'admin',
|					display_name => 'Administrator',
|					privileges => '10'
|				)
*/
/**
 * Session constants - these values are the keys in above structure
 * 
 */
$config['session']['logged_in']   = 'logged_in';
$config['session']['logged_user'] = 'logged_user';

/**
 * app URLs
 * 
 */
$config['url']['login'] 	 = 'auth';
$config['url']['logout'] 	 = 'auth/logout';
$config['url']['dashboard']  = 'dashboard';
$config['url']['list_event'] = 'event';
$config['url']['add_event']  = 'event/add';
$config['url']['edit_event'] = 'event/edit';
$config['url']['delete_event'] = 'event/delete';
// $config['url']['list_user']  = 'user';
// $config['url']['add_user']   = 'user/add';
// $config['url']['edit_user']  = 'user/edit';
// $config['url']['delete_user']  = 'user/delete';


/*
| -------------------------------------------------------------------
|  privileges
| -------------------------------------------------------------------
|
| array (
|		0 => array(
|					display_name => 'Dashboard',
|					url => BASE_URL . $config['url']['dashboard']
|			)
|		...
|	)
*/
/*$config['privileges'] = array(

		0 => array('display_name' => 'Admin', 'url' => $config['base_url']),
		1 => array('display_name' => 'Dashboard', 'url' => $config['base_url'] . $config['url']['dashboard']),

		5 => array('display_name' => 'User Management', 'url' => $config['base_url'] . $config['url']['list_user']),
		6 => array('display_name' => 'Add new user', 'url' => $config['base_url'] . $config['url']['add_user']),
		7 => array('display_name' => 'Edit', 'url' => $config['base_url'] . $config['url']['edit_user']),
		8 => array('display_name' => 'Delete', 'url' => $config['base_url'] . $config['url']['delete_user']),

		11 => array('display_name' => 'Events', 'url' => $config['base_url'] . $config['url']['list_event']),
		12 => array('display_name' => 'Add new event', 'url' => $config['base_url'] . $config['url']['add_event']),
		13 => array('display_name' => 'Edit', 'url' => $config['base_url'] . $config['url']['edit_event']),
		14 => array('display_name' => 'Delete', 'url' => $config['base_url'] . $config['url']['delete_event'])

	);*/

?>