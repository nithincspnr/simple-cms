<?php

function pip()
{
	global $config;
    
    // Set our defaults
    $controller = $config['default_controller'];
    $action = 'index';
    $url = '';
	
	// Get request url and script url
	$request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
	$script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';
    	
	// Get our url path and trim the / of the left and the right
	if($request_url != $script_url) $url = trim(preg_replace('/'. str_replace('/', '\/', str_replace('index.php', '', $script_url)) .'/', '', $request_url, 1), '/');
   
	// Split the url into segments
	$segments = explode('/', $url);

	// Do our default checks & 
	// Removes GET params from segments like ?message='Hello world' since it breaks the flow
	if(isset($segments[0]) && $segments[0] != '') $controller = strpos($segments[0], '?') !== false ? strstr($segments[0], '?', true) : $segments[0];
	if(isset($segments[1]) && $segments[1] != '') $action = strpos($segments[1], '?') !== false ? strstr($segments[1], '?', true) : $segments[1];
	
	// Get our controller file
    $path = APP_DIR . 'controllers/' . $controller . '.php';
    
	if(file_exists($path)){
        require_once($path);
	} else {
        $controller = $config['error_controller'];
        require_once(APP_DIR . 'controllers/' . $controller . '.php');
	}

    // Check the action exists
    if(!method_exists($controller, $action)){
        $controller = $config['error_controller'];
        require_once(APP_DIR . 'controllers/' . $controller . '.php');
        $action = 'index';
    }

	// Create object and call method
	$obj = new $controller;

	// note :
	// The 2nd param in call_user_func_array is segment array (sliced)
	// which contains extra params comes after controller/action .
	// In default the extra param is available in each functions in the controller
	// i missed it !
    die(call_user_func_array(array($obj, $action), array_slice($segments, 2)));
}

?>
