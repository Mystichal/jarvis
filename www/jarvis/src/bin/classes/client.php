<?php
class client extends application {
	public function exist($name, $password) {
		$qstring = 'SELECT * FROM auth_clients WHERE name = :name AND password = :password';
		$this->database->connect();
		$this->database->sql($qstring, array('name' => $name, 'password' => $password));
		$data = $this->database->getResult();
		$this->database->disconnect();

		return $data;
	}

	public function byId($id) {
		$qstring = 'SELECT * FROM auth_clients WHERE id = :id';
		$this->database->connect();
		$this->database->sql($qstring, array(':id' => $id));
		$data = $this->database->getResult();
		$this->database->disconnect();

		return $data[0];
	}
}