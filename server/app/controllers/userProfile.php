<?php
class UserProfile extends App\Core\Controller {
	public function index($id = '') {
		$entity = $this->model('User', $id);
		$user = $entity->getData('User');
		if ($user != '') {
			echo json_encode($user);
		} else {
			echo json_encode('Error: User controller could not load the data.');
		}
	}
}