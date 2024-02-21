<?php

class character extends application {
	public $id;
	public $name;
	public $pos_x = 0;
	public $pos_y = 0;
	public $pos_z = 0;
	public $current_room;
	public $active = false;
	public $created = date('Y-m-d H:i:s');
	public $created_by;
	public $updated;
	public $updated_by;

	public function exist() {
		$qstring = 'SELECT * FROM spacecraft_characters WHERE name = :name';

		$this->database->connect();
		$this->database->sql($qstring, array(':name' => $this->name));
		$data = $this->database->getResult();
		$this->database->disconnect();

		return $data[0];
	}

	public function insert() {
		$qstring = 'INSERT INTO spacecraft_characters(name, current_room, pos_x, pos_y, pos_z, active, updated, updated_by, created, created_by VALUES(:name, :current_room, :pos_x, :pos_y, :pos_z, :active, :updated, :updated_by, :created, :created_by);';

		$this->database->connect();
		$this->database->sql($qstring, array(
			':name'			=> $this->name, 
			':current_room' => $this->current_room,
			':pos_x'		=> $this->pos_x,
			':pos_y'		=> $this->pos_y,
			':pos_z'		=> $this->pos_z,
			':active'		=> $this->active,
			':updated'		=> $this->updated,
			':updated_by'	=> $this->updated_by,
			':created'		=> $this->created, 
			':created_by'	=> $this->created_by
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
		$qstring = 'UPDATE spacecraft_characters SET name = :name, current_room = :current_room, pos_x = :pos_x, pos_y = :pos_y, pos_z = :pos_z, active = :active, updated = :updated, updated_by = :updated_by WHERE id = :id';

		$this->database->connect();
		$this->database->sql($qstring, array(
			':name'			=> $this->name, 
			':current_room' => $this->current_room,
			':pos_x'		=> $this->pos_x,
			':pos_y'		=> $this->pos_y,
			':pos_z'		=> $this->pos_z,
			':active'		=> $this->active,
			':updated'		=> $this->updated,
			':updated_by'	=> $this->updated_by,
			':created'		=> $this->created, 
			':created_by'	=> $this->created_by
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
		$qstring = 'SELECT * FROM spacecraft_characters WHERE id = :id';
		$this->database->connect();
		$this->database->sql($qstring, array(':id' => $this->id));
		$data = $this->database->getResult();
		$this->database->disconnect();

		return $data[0];
	}
}