<?php
	require_once("config.php");

	spl_autoload_register(function ($class_name) {
		$class = explode("_", $class_name);
		$path = implode("/", $class). ".php";
		require_once($path);
	});