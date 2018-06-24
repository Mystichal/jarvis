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

	public function view($view = '', $data = array()) {
		if (file_exists('../app/views/' . $view . '.php')) {
			require_once '../app/templates/header.php';
			require_once '../app/views/' . $view . '.php';
			require_once '../app/templates/footer.php';
		} else {
			/** TODO ^ **/
			echo 'the view does not exist';
		}
	}
}