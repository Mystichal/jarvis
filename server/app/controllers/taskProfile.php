<?php
class TaskProfile extends App\Core\Controller {
	public function index($id = '') {
		$entity = $this->model('Task', $id);
		$task = $entity->getData('Task');
		if ($task != '') {
			echo json_encode($task);
		} else {
			echo json_encode('Error: Task controller could not load the data.');
		}
	}
}