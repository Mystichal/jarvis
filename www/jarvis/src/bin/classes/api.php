<?php

class api {
	protected $request;
	protected $serviceName;
	protected $parameters;
	protected $clientId;

	public function __construct() {
		if ($_SERVER['REQUEST_URI'] == '/jarvis/' && $_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->displayReadme();
		}
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->throwError(REQUEST_METHOD_NOT_VALID, 'method not vaild');
		}
		$handler = fopen('php://input', 'r');
		$this->request = stream_get_contents($handler);
		$this->validateRequest();

		if ('generatetoken' != strtolower($this->serviceName)) {
			$this->validateToken();
		}
	}

	public function validateRequest() {
		if (isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] !== 'application/json') {
			$this->throwError(REQUEST_CONTENTTYPE_NOT_VALID, 'content type not vaild');
		}

		$data = json_decode($this->request, true);

		if (!isset($data['name']) || $data['name'] == '') {
			$this->throwError(API_NAME_REQUIRED, 'name required');
		}
		$this->serviceName = $data['name'];

		if (!isset($data['parameters']) || !is_array($data['parameters']))  {
			$this->throwError(API_PARAM_REQUIRED, 'faulty parameter structure');
		}
		$this->parameters = $data['parameters'];
	}

	public function processApi() {
		$core = new core;
		$rMethod = new reflectionMethod('core', $this->serviceName);
		if (!method_exists($core, $this->serviceName)) {
			$this->throwError(API_DOES_NOT_EXIST, 'api does not exist');
		}
		$rMethod->invoke($core);
	}

	public function validateParameter($fieldName, $value, $dataType, $required = true) {
		if ($required == true && empty($value) == true) {
			$this->throwError(VALIDATE_PARAMETER_REQUIRED, $fieldName . ' parameter is required');
		}

		switch ($dataType) {
			case BOOLEAN:
				if (!is_bool($value)) {
					$this->throwError(VALIDATE_PARAMETER_DATATYPE, 'Datatype not valid for ' . $fieldName . 'should be BOOLEAN');
				}
				break;
			case INTEGER:
				if (!is_numeric($value)) {
					$this->throwError(VALIDATE_PARAMETER_DATATYPE, 'Datatype not valid for ' . $fieldName . 'should be INTEGER');
				}
				break;
			case STRING:
				if (!is_string($value)) {
					$this->throwError(VALIDATE_PARAMETER_DATATYPE, 'Datatype not valid for ' . $fieldName . 'should be STRING');
				}
				break;
			default:
				break;
		}

		return $value;
	}

	public function validateToken() {
		try {
			$client = new client;
			$token = $this->getClientToken();
			
			$payload = JWT::decode($token, SECRETE_KEY, ['HS256']);

			$data = $client->byId($payload->clientId);

			$this->validateClient($data);
			$this->clientId = $payload->clientId;
		} catch (Exception $e) {
			$this->returnResponse(ACCESS_TOKEN_ERROR, $e->getMessage());
		}
	}

	public function throwError($code, $message) {
		header('content-type: application/json');
		echo json_encode(['error' => ['status' => $code, 'message' => $message]]);
		exit;
	}

	public function returnResponse($code, $data) {
		header('content-type: application/json');
		$response = json_encode(['response' => ['status' => $code, 'result' => $data]]);
		echo $response;
		exit;
	}

	public function getAuthorizationHeader() {
		$headers = null;
		if (isset($_SERVER['Authorization'])) {
			$headers = trim($_SERVER['Authorization']);
		} else if (isset($_SERVER['HTTP_Authorization'])) {
			$headers = trim($_SERVER['HTTP_Authorization']);
		} elseif (function_exists('apache_request_headers')) {
			$requestHeaders = apache_request_headers();
			$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
			if (isset($requestHeaders['Authorization'])) {
				$headers = trim($requestHeaders['Authorization']);
			}
		}

		return $headers;
	}

	public function getClientToken() {
		$headers = $this->getAuthorizationHeader();
		if (!empty($headers)) {
			if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
				return $matches[1];
			}
		}
		$this->throwError(AUTHORIZATION_HEADER_NOT_FOUND, 'token not found');
	}

	public function validateClient($data) {
		if (!is_array($data)) {
			$this->returnResponse(INVALID_CLIENT_PASSWORD, 'incorrect name or password');
		}
		if (!isset($data['active']) || $data['active'] == 0) {
			$this->returnResponse(CLIENT_NOT_ACTIVE, 'incorrect name or password');
		}
	}

	public function displayReadme() {
		header('content-type: text/html');
		$css = file_get_contents('./public/css/main.css');
		$js = file_get_contents('./public/js/main.js');
		$readme = file_get_contents('./../../README.md');

		echo '<style>' . $css . '</style>';
		echo '<script type="module">' . $js . '</script>';
		echo markdownparser::render($readme);

		exit;
	}
}
