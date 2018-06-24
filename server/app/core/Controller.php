<?php
namespace App\Core;

class Controller {
	public function model($model = '', $id = 0, $data = array()) {
		if (file_exists('../app/models/' . $model . '.php')) {
			require_once '../app/models/' . $model . '.php';
			$modelWrapper = 'App\\Models\\' . $model;
			return new $modelWrapper($model, $id, $data);
		} else {
			/** TODO, make a error proccess **/
			echo 'the model does not exist';
		}
	}
}