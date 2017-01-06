<?php

class Model {

	private $db_host,
			$db_name,
			$db_username,
			$db_password;
	public $mysqli_instance;

	public function __construct()
	{
		global $config;
		$this->db_host = $config['app_cofig']['database']['host'];
		$this->db_name = $config['app_cofig']['database']['name'];
		$this->db_username = $config['app_cofig']['database']['username'];
		$this->db_password = $config['app_cofig']['database']['password'];
		$this->mysqli_instance = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);
	}

	public function query($qry)
	{
		$result = $this->mysqli_instance->query($qry);
		while ($row = $result->fetch_object()) $resultObjects[] = $row;
		return $resultObjects;
	}

	public function close()
	{
	    $this->mysqli_instance->close();
	}

	public function execute($qry)
	{
		$exec = $this->mysqli_instance->query($qry);
		return $exec;
	}

	public function escapeString($string)
	{
		return $this->mysqli_instance->real_escape_string($string);
	}
	
	public function to_bool($val)
	{
	    return !!$val;
	}
	
	public function to_date($val)
	{
	    return date('Y-m-d', $val);
	}
	
	public function to_time($val)
	{
	    return date('H:i:s', $val);
	}
	
	public function to_datetime($val)
	{
	    return date('Y-m-d H:i:s', $val);
	}

}

