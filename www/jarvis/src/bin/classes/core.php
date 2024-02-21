<?php
// API
class core extends api {
	public function __construct() {
		parent::__construct();
	}

	public function generateToken() {
		$client = new client;

		$name = $this->validateParameter('name', $this->parameters['name'], STRING, true);
		$password = $this->validateParameter('password', $this->parameters['password'], STRING, true);
		$data = $client->exist($name, $password);
		
		$this->validateClient($data[0]);

		$payload = [
			'iat' => time(),
			'iss' => 'localhost',
			'exp' => time() + (60),
			'clientId' => $data[0]['id']
		];

		try {
			$token = JWT::encode($payload, SECRETE_KEY);
			$response = ['token' => $token];
			$this->returnResponse(SUCCESS_RESPONSE, $response);
		} catch (Exception $e) {
			$this->returnResponse(JWT_PROCESSING_ERROR, $e->getMessage());
		}
	}

	public function userExist() {
		$email = $this->validateParameter('email', $this->parameters['email'], STRING, true);

		try {
			$auth_user = new user;
			$auth_user->email = $email;
			$data = $auth_user->exist();

			if (!is_array($data)) {
				$this->returnResponse(SUCCESS_RESPONSE, ['message' => 'couldent find the user you where looking for']);
			}

			$this->returnResponse(SUCCESS_RESPONSE, true);
		} catch (Exception $e) {
			$this->returnResponse(ACCESS_TOKEN_ERROR, $e->getMessage());
		}
	}

	public function getUser() {
		$email = $this->validateParameter('email', $this->parameters['email'], STRING, true);

		try {
			$auth_user = new user;
			$auth_user->email = $email;
			$data = $auth_user->exist();

			if (!is_array($data)) {
				$this->returnResponse(SUCCESS_RESPONSE, ['message' => 'couldent find the user you where looking for']);
			}

			$this->returnResponse(SUCCESS_RESPONSE, $response['user']);
		} catch (Exception $e) {
			$this->returnResponse(ACCESS_TOKEN_ERROR, $e->getMessage());
		}
	}

	public function userById() {
		$id = $this->validateParameter('id', $this->parameters['id'], INTEGER, true);

		try {
			$user = new user;
			$user->setId($id);
			$data = $user->byId();

			if (!is_array($data)) {
				$this->returnResponse(SUCCESS_RESPONSE, ['message' => 'couldent find the user you where looking for']);
			}

			$response['user'] = json_encode($data);

			$this->returnResponse(SUCCESS_RESPONSE, $response);
		} catch (Exception $e) {
			$this->returnResponse(ACCESS_TOKEN_ERROR, $e->getMessage());
		}
	}

	public function addUser() {
		$email = $this->validateParameter('email', $this->parameters['email'], STRING);
		$password = $this->validateParameter('password', $this->parameters['password'], STRING);

		if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
			$this->returnResponse(SQL_VIOLATION, 'Invalid email address');
		} 

		$created_by = JWT::decode($this->getClientToken(), SECRETE_KEY, ['HS256'])->clientId;

		try {
			$auth_user = new user;
			$auth_user->email = $email;
			$auth_user->password = $password;
			$auth_user->created = date('Y-m-d H:i:s');
			$auth_user->created_by = $created_by;

			if (!$auth_user->insert()) {
				$message = 'failed to add user';
			} else {
				$message = 'added user successfully';
			}

			$this->returnResponse(SUCCESS_RESPONSE, $response);
		} catch (Exception $e) {
			$this->returnResponse(SQL_VIOLATION, $e->getMessage());
		}
	}
}
