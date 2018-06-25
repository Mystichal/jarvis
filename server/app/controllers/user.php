<?php
class User extends App\Core\Controller {
	public function index($id = '') {
		$user = $this->model('User', $id);
		$data = $user->getData('User');
		if ($data != '') {
			echo json_encode($data);
		} else {
			echo json_encode('Error: User controller could not load the data.');
		}
	}
}