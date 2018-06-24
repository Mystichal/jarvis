<?php
namespace App\Models;

class Entities {
	protected $objects_;
	protected $ids_;

	public function __construct($model = '') {
		$this->objects_ = array();
	}

	private function _fetchAllIds($model = '') {
		$database = new \App\Core\Database();
		$database->connect();
		$database->select($model, 'id');
		$data = $database->getResult();
		$database->disconnect();
		$ids = array();

		foreach ($data as $key => $value) {
			if (isset($value['id'])) {
				array_push($ids, $value['id']);
			}
		}
		$this->ids_ = $ids;
		return $ids;
	}

	public function fetchAll($model = '') {
		$ids = $this->_fetchAllIds($model);
		foreach ($ids as $id) {
			$object = new Entity($model, $id);
			$this->objects_[$model][$id] = $object->getData($model);
		}
	}

	public function getAllIds($model = '') {
		return $this->_fetchAllIds($model);
	}

	public function getAll($model = '') {
		if (!empty($this->objects_[$model])) {
			return $this->objects_[$model];
		}
	}
}