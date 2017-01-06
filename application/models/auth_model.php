<?php

class Auth_model extends Model {
	
	public function login($param)
	{
		$username 	= $this->escapeString($param['uname']);
		$password 	= $this->escapeString($param['password']);
		$result 	= $this->getUser($username, $password);
		return $result;
	}
	
	public function getUser($username, $password)
	{
		$mysqli	= $this->mysqli_instance;
		$res 	= array();
		$result = $mysqli->query('select id, username, display_name, privileges from users where username="'.$username.'" and password="'.$this->base64Encode($password).'"');
		
		if(!$result) die($mysqli->error);

		while ($data = $result->fetch_object()) {
			$res[]  = array(
						'id' => $data->id,
						'username' => $data->username,
						'display_name' => $data->display_name,
						'privileges' => $data->privileges
					);
		}

		$mysqli->close();
		return $res;
	}
	
	public function base64Encode($param)
	{
		return base64_encode($param);
	}

}

