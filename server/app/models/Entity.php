<?php
namespace App\Models;

class Entity {
	protected $keys_;
	protected $data_;

	public function __construct($model = '', $id = 0, $data = array()) {
		$this->keys_ = array();
		$this->data_ = array();

		if ($id > 0) {
			$this->_load($model, $id);
		} elseif (!empty($data)) {
			foreach ($data as $key => $value) {
				$this->data_[$model][$key] = $value;
			}
		}
	}

	private function _load($model = '', $id = 0) {
		if ($this->_exist($model, $id)) {
			$this->_getKeys($model);
			$database = new \App\Core\Database();
			$database->connect();
			$database->select($model, '*', NULL, 'id="' . $id . '"');
			$data = $database->getResult();
			$database->disconnect();

			foreach ($data[0] as $key => $value) {
				$this->data_[$model][$key] = $value;
			}
			$this->data_[$model]['id'] = $id;
		}
	}

	private function _exist($model = '', $id = 0) {
		$database = new \App\Core\Database();
		$database->connect();
		$database->select($model, '*', NULL, 'id="' . $id . '"');
		$num = $database->numRows();
		$database->disconnect();

		return ($num > 0) ? true : false;
	}

	private function _getKeys($model = '') {
		$database = new \App\Core\Database;
		$database->connect();
		$this->keys_ = $database->getColumns($model);
		unset($this->keys_[0]);
		$database->disconnect();
	}

	private function _new($model = '') {
		$data = $this->getData($model);
		$database = new \App\Core\Database();
		$database->connect();
		$database->insert($model, $data);
		$database->select($model, '*');
		$id = $database->numRows() + 1;
		$database->disconnect();

		$this->data_[$model]['id'] = $id;
	}

	public function getKeys() {
		return $this->keys_;
	}

	public function getData($model = '', $key = '') {
		if ($key != '') {
			return $this->data_[$model][$key];
		} else {
			if (!empty($this->data_)) {
				return $this->data_[$model];
			}
		}

	}
}