<?php

class Session_helper {

	public function set($key, $val)
	{
		$_SESSION["$key"] = $val;
	}
	
	public function get($key)
	{
		return $_SESSION["$key"];
	}

	public function isLoggedInUser($key)
	{

		if(isset($_SESSION["$key"]))
			return $_SESSION["$key"] ? $_SESSION["$key"] : 0;
		else
			return 0;
	}

	public function setLoggedInUser($data)
	{
		global $config, $constants;
		
		switch (count($data)) {

			case 0:
				$this->set($config['session']['logged_in'], false);
				return $this->redirect($config['url']['login'], $constants[1]);
				break;

			case 1: // login case
				$this->set($config['session']['logged_in'], true);
				$this->set($config['session']['logged_user'], $data[0]);
				break;

			default:
				$this->set($config['session']['logged_in'], false);
				return $this->redirect($config['url']['login'], $constants[0]);
				break;
		}

		// improve code for other redirection option
		return $this->redirect($config['url']['dashboard']);
	}

	public function redirect($loc = null, $msg = null)
	{
		global $config;
		$tail = $loc.( isset($msg) ? '?msg='.$msg : '' );
		header('Location: '. $config['base_url'] . $tail);
	}

	/**
	 * http://www.php.net/manual/en/function.session-destroy.php
	 * Example #1 Destroying a session with $_SESSION
	 */
	public function destroy()
	{
		// Unset all of the session variables.
		$_SESSION = array();
		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}
		// Finally, destroy the session.
		session_destroy();

		return $this->redirect();
	}

}

?>