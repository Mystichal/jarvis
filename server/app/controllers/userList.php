<?php
class UserList extends App\Core\Controller {
	public function index() {
		$entities = $this->model('Users');
		$entities->fetchAll('User');
		$users = $entities->getAll('User');
		if ($users != '') {
			echo json_encode($users);
		} else {
			echo json_encode('Error: Users controller could not load the data.');
		}
	}
}