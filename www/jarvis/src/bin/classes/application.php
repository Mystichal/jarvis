<?php
class application {
	public $database;

	public function __construct() {
		$this->database = new database();
	}
}