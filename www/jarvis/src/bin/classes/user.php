<?php

class user extends application {
	public $id;
	public $email;
	public $password;
	public $active = 0;
	public $created;
	public $created_by;
	public $updated;
	public $updated_by;

	public function exist() {
		$qstring = 'SELECT * FROM auth_users WHERE email = :email';

		$this->database->connect();
		$this->database->sql($qstring, array(':email' => $this->email));
		$data = $this->database->getResult();
		$this->database->disconnect();

		return $data[0];
	}

	public function insert() {
		$qstring = 'INSERT INTO auth_users(email, password, active, created, created_by) VALUES(:email, :password, :active, :created, :created_by);';

		$this->database->connect();
		$this->database->sql($qstring, array(
			':email'      => $this->email, 
			':password'   => $this->password,
			':active'     => $this->active,
			':created'    => $this->created, 
			':created_by' => $this->created_by
		));
		$result = $this->database->getResult();
		$this->database->disconnect();

		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	public function update() {
		$qstring = 'UPDATE auth_users SET email = :email, password = :password, active = :active, updated = :updated, updated_by = :updated_by WHERE id = :id';

		$this->database->connect();
		$this->database->sql($qstring, array(
			':email'      => $this->email, 
			':password'   => $this->password,
			':active'     => $this->active,
			':updated'    => $this->updated,
			':updated_by' => $this->updated_by,
			':created'    => $this->created, 
			':created_by' => $this->created_by
		));
		$result = $this->database->getResult();
		$this->database->disconnect();

		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	public function byId() {
		$qstring = 'SELECT * FROM auth_users WHERE id = :id';
		$this->database->connect();
		$this->database->sql($qstring, array(':id' => $this->id));
		$data = $this->database->getResult();
		$this->database->disconnect();

		return $data[0];
	}
}