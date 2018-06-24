<?php
if (!isset($_SESSION)) {
	session_start();
}

defined("SITE_URL")
|| define("SITE_URL", "http://" . $_SERVER['SERVER_NAME']);

defined("DS")
|| define("DS", DIRECTORY_SEPARATOR);

defined("ROOT_PATH")
|| define("ROOT_PATH", realpath(dirname(__FILE__) . DS . ".." . DS));

defined("CONTROLLERS_DIR")
|| define("CONTROLLERS_DIR", "controllers");

defined("CORE_DIR")
|| define("CORE_DIR", "core");

defined("INC_DIR")
|| define("INC_DIR", "inc");

defined("br")
|| define("br", "</br>");

defined("ps")
|| define("ps", "<p>");

defined("pe")
|| define("pe", "</p>");

set_include_path(implode(PATH_SEPARATOR, array(
	realpath(ROOT_PATH . DS . CONTROLLERS_DIR),
	realpath(ROOT_PATH . DS . CORE_DIR),
	realpath(ROOT_PATH . DS . INC_DIR),
	get_include_path(),
)));
