<?php
class Api {
	public $url;
	public $result;
	public $resultJson;

	public function __construct() {
		$url = rtrim(dirname($_SERVER['PHP_SELF']), '/');
		$url = 'http://' . $_SERVER['HTTP_HOST'] . implode('/', (array_slice(explode('/', $url), 0, -1))) . '/server/public/';
		$this->url = $url;
	}

	public function getUser($id = 0) {
		return $this->_call('userprofile/' . $id . '/');
	}

	private function _call($function = '', $data = array()) {
		$postdata = json_encode($data);
		$opts = array('http' => array(
			'method' => 'POST',
			'header' => 'Content-type: application/json',
			'content' => $postdata,
		),
		);

		$url = $this->url . $function;

		$context = stream_context_create($opts);
		$resultJson = file_get_contents($url, false, $context);
		return json_decode($resultJson, true);
	}

}