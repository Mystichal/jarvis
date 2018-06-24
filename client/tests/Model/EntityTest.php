<?php

class EntityTest extends \PHPUnit\Framework\TestCase {
	public function testEntitiyLoad() {
		$model = 'EntityTest';
		$testData = array(
			'a' => '0',
			'b' => '1',
			'c' => '2',
			'd' => '3',
		);

		$user = new App\Models\Entity($model, NULL, $testData);

		foreach ($testData as $key => $value) {
			$this->assertEquals($user->getData($model, $key), $value);
		}
	}

	public function testEntitiySave() {
		$model = 'EntityTest';
		$testData = array(
			'a' => '0',
			'b' => '1',
			'c' => '2',
			'd' => '3',
		);
	}
}