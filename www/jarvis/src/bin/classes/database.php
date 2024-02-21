<?php
class database {
	private $conStr = '';
	private $con = false;
	private $PDO = '';
	private $result = array();
	private $myQuery = '';
	private $numResults = '';

	public function readConf() {
		try {
			$params = [
				'DB_HOST' => getenv('DB_HOST'),
				'DB_NAME' => getenv('DB_NAME'),
				'DB_USER' => getenv('DB_USER'),
				'DB_PASS' => getenv('DB_PASS')
			];
		} catch (\Throwable $th) {
			throw new Exception("Error reading database configuration file");
		}
	
		$conStr = sprintf("pgsql:host=%s;dbname=%s;user=%s;password=%s",
			$params['DB_HOST'],
			$params['DB_NAME'],
			$params['DB_USER'],
			$params['DB_PASS']
		);

		$this->conStr = $conStr;
	}

	public function connect() {
		if (!$this->con) {
			$this->readConf();

			try {
				$this->PDO = new PDO($this->conStr);
				$this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (\PDOExeption $e) {
				array_push($this->result, $e->getMessage());
				return false;
			}

			$this->con = true;
			return true;
		} else {
			return true;
		}
	}

	public function disconnect() {
		if ($this->con) {
			if ($this->PDO == '') {
				$this->con = false;
				return true;
			} else {
				return false;
			}
		}
	}

	public function sql($qstring, $parameters) {
		try {
			$stmt = $this->PDO->prepare($qstring);
			foreach ($parameters as $key => $value) {
				$stmt->bindValue($key, $value);
			}
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
			array_push($this->result, $data);
		} catch (\PDOExeption $e) {
			array_push($this->result, $e->getMessage());
			return false;
		}
		
		return true;
	}

	public function getResult() {
		$val = $this->result;
		$this->result = array();
		return $val;
	}
}
