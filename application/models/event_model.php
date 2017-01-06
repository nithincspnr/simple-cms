<?php

class Event_model extends Model {
	
	public function insertEvent($param)
	{
		$mysqli	= $this->mysqli_instance;
		$date   = (new DateTime($this->escapeString($param['date'])))->format('Y-m-d H:i:s');

		$result = $mysqli->query('insert into events (event_title, event_place, event_date, event_note) values (
					"'.$this->escapeString($param['name']).'" , "'.$this->escapeString($param['place']).'", "'.$date.'", "'.$this->escapeString($param['note']).'"
					)');
		
		if(!$result) die($mysqli->error);

		$mysqli->close();
		return $result;
	}

	public function updateEvent($param)
	{

		$mysqli	= $this->mysqli_instance;
		$date   = (new DateTime($this->escapeString($param['date'])))->format('Y-m-d H:i:s');

		$result = $mysqli->query('update events set event_title="'.$this->escapeString($param['name']).'", 
			event_place="'.$this->escapeString($param['place']).'", event_date="'.$this->escapeString($param['date']).'",
			event_note="'.$this->escapeString($param['note']).'", modified_at = NOW() where id = '.$this->escapeString($param['id']));
		
		if(!$result) die($mysqli->error);

		$mysqli->close();
		return $result;
	}

	public function deleteEvent($param)
	{

		$mysqli	= $this->mysqli_instance;
		$result = $mysqli->query('delete from events where id = '.$this->escapeString($param['id']));
		
		if(!$result) die($mysqli->error);

		$mysqli->close();
		return $result;
	}

	public function getEventData($id)
	{
		$mysqli	= $this->mysqli_instance;
		$rs 	= $mysqli->query('select * from events where id='.$this->escapeString($id));

		$result = array();
		while ( $row = $rs->fetch_assoc() ) {
			$result[]  = $row;
		}

		if(!$result) die($mysqli->error);

		$mysqli->close();
		return isset($result[0]) ? $result[0] : $result;
	}
}

