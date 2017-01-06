<?php

class Event extends Controller {

	private $helper;
	public function __construct()
	{
		global $config;
		$this->helper   = $this->loadHelper('Session_helper');
		$loggedIn       = $this->helper->isLoggedInUser($config['session']['logged_in']);
		
		if(!$loggedIn)
			$this->helper->redirect($config['url']['login'] );

	}
	
	public function index()
	{
		global $config;
		$param    = $_REQUEST;
		$result   = $this->getData($param);
		$template = $this->loadView('list_events');
		$template->set('title', 'Events');
		$template->set('nav_event', true);
		$template->set('data', $result['data']);
		$template->set('pagintation', $result['pagintation']);
		$template->set('paginationInfo', $result['paginationInfo']);
		$template->set('_edit', $config['url']['edit_event']);
		$template->set('_delete', $config['url']['delete_event']);
		$template->render();
	}

	public function add()
	{
		$template = $this->loadView('add_event');
		$template->set('title', 'Add event');
		$template->set('nav_event', true);
		$template->set('action', './addEvent');		
		$template->set('method', 'post');	
		$template->render();

	}

	public function addEvent()
	{
		global $config, $constants;

		$model 	= $this->loadModel('Event_model');
		$result = $model->insertEvent($_REQUEST);

		if ($result) {
			$this->helper->redirect($config['url']['list_event'], $constants[2]);
		} else {
			$this->helper->redirect($config['url']['list_event'], $constants[0]);
		}

	}

	public function edit()
	{

		$template = $this->loadView('edit_event');
		$template->set('title', 'Add event');
		$template->set('nav_event', true);
		$template->set('action', './updateEvent');
		$template->set('method', 'post');

		$model 	= $this->loadModel('Event_model');
		$id     = $_REQUEST['id'];
		$data   = $model->getEventData($id);

		$template->set('id', $data['id']);
		$template->set('name', $data['event_title']);
		$template->set('place', $data['event_place']);
		$template->set('date', $data['event_date']);
		$template->set('note', $data['event_note']);

		$template->render();

	}

	public function updateEvent()
	{
 		global $config, $constants;

		$model 	= $this->loadModel('Event_model');
		$result = $model->updateEvent($_REQUEST);

		if ($result) {
			$this->helper->redirect($config['url']['list_event'], $constants[3]);
		} else {
			$this->helper->redirect($config['url']['list_event'], $constants[0]);
		}

	}

	public function delete()
	{
 		global $config, $constants;

		$model 	= $this->loadModel('Event_model');
		$result = $model->deleteEvent($_REQUEST);

		if ($result) {
			$this->helper->redirect($config['url']['list_event'], $constants[4]);
		} else {
			$this->helper->redirect($config['url']['list_event'], $constants[0]);
		}

	}

	private function getData($param = array())
	{
		
		$paginator = $this->loadHelper('Paginator');
		$model 	   = $this->loadModel('Event_model');
		$query	   = 'select * from events';

		$paginator->initialise($model->mysqli_instance, $query);

		$limit = empty($param['limit']) ? 8 : $param['limit'];
		$page  = empty($param['page'])  ? 1  : $param['page'];

		$data 		 = $paginator->getData($limit, $page);
		$pagintation = $paginator->createLinks(2,'');

		$start = ($data->limit * ($data->page - 1)) + ( $data->total > 0 ? 1 : 0);
		$end   = ( ($data->limit * $data->page) <= $data->total ) ? $data->limit * $data->page : $data->total;
		$paginationInfo = 'Showing '.$start.'-'.$end.' of '.$data->total;
		
		return array(
			"data" => $data->data,
			"pagintation" => $pagintation,
			"paginationInfo" => $paginationInfo
		);
	}
    
}

?>
