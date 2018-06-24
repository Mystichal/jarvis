<?php
class TaskList extends App\Core\Controller {
	public function index() {
		$entities = $this->model('Tasks');
		$entities->fetchAll('Task');
		$tasks = $entities->getAll('Task');
		if ($tasks != '') {
			echo json_encode($tasks);
		} else {
			echo json_encode('Error: Tasks controller could not load the data.');
		}
	}
}