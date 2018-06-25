<?php
class Tasks extends App\Core\Controller {
	public function index() {
		$tasks = $this->model('Tasks');
		$tasks->fetchAll('Task');
		$data = $tasks->getAll('Task');
		if ($data != '') {
			echo json_encode($data);
		} else {
			echo json_encode('Error: Tasks controller could not load the data.');
		}
	}
}