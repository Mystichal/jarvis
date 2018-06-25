<?php
class Users extends App\Core\Controller {
	public function index() {
		$entities = $this->model('Users');
		$entities->fetchAll('Users');
		$users = $entities->getAll('Users');
		if ($users != '') {
			echo json_encode($users);
		} else {
			echo json_encode('Error: Users controller could not load the data.');
		}
	}
}