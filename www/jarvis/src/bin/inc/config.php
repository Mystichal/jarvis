<?php
if(!isset($_SESSION)) {
	session_start();
}

defined('SITE_URL')
	|| define('SITE_URL', 'http://' . $_SERVER['SERVER_NAME']);

defined('DS')
	|| define('DS', DIRECTORY_SEPARATOR);

defined('ROOT_PATH')
	|| define('ROOT_PATH', realpath(dirname(__FILE__) . DS . '..' . DS));

defined('CLASSES_DIR')
	|| define('CLASSES_DIR', 'classes');

defined('INC_DIR')
	|| define('INC_DIR', 'inc');

set_include_path(implode(PATH_SEPARATOR, array(
	realpath(ROOT_PATH . DS . CLASSES_DIR),
	realpath(ROOT_PATH . DS . INC_DIR),
	get_include_path()
)));

defined('SECRETE_KEY')
	|| define('SECRETE_KEY', 'G-KaPdSg%D*G-JaNw!z%C*F)3t6w9z$CkYp3s6v9RgUkXp2s@NcRfUjXE)H@McQf$B&E(H+Mv8y/B?E(');


defined('BOOLEAN')
	|| define('BOOLEAN', '1');

defined('INTEGER')
	|| define('INTEGER', '2');

defined('STRING')
	|| define('STRING', '3');


defined('REQUEST_METHOD_NOT_VALID')
	|| define('REQUEST_METHOD_NOT_VALID', 100);

defined('REQUEST_CONTENTTYPE_NOT_VALID')
	|| define('REQUEST_CONTENTTYPE_NOT_VALID', 101);

defined('REQUEST_NOT_VALID')
	|| define('REQUEST_NOT_VALID', 102);

defined('VALIDATE_PARAMETER_REQUIRED')
	|| define('VALIDATE_PARAMETER_REQUIRED', 103);

defined('VALIDATE_PARAMETER_DATATYPE')
	|| define('VALIDATE_PARAMETER_DATATYPE', 104);

defined('API_NAME_REQUIRED')
	|| define('API_NAME_REQUIRED', 105);

defined('API_PARAM_REQUIRED')
	|| define('API_PARAM_REQUIRED', 106);

defined('API_DOES_NOT_EXIST')
	|| define('API_DOES_NOT_EXIST', 107);

defined('INVALID_CLIENT_PASSWORD')
	|| define('INVALID_CLIENT_PASSWORD', 108);

defined('CLIENT_NOT_ACTIVE')
	|| define('CLIENT_NOT_ACTIVE', 109);

defined('SQL_VIOLATION')
	|| define('SQL_VIOLATION', 110);
	

defined('SUCCESS_RESPONSE')
	|| define('SUCCESS_RESPONSE', 200);


defined('JWT_PROCESSING_ERROR')
	|| define('JWT_PROCESSING_ERROR', 300);

defined('AUTHORIZATION_HEADER_NOT_FOUND')
	|| define('AUTHORIZATION_HEADER_NOT_FOUND', 301);

defined('ACCESS_TOKEN_ERROR')
	|| define('ACCESS_TOKEN_ERROR', 302);