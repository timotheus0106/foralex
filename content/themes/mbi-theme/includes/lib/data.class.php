<?php

Class Data {

	public $get;

	public function add($key, $value) {

		$this->get[$key] = $value;

	}

}

$data = new Data();