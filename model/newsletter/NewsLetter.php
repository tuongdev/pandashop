<?php
class NewsLetter {
	protected $email;

	function __construct($email) {
		$this->email = $email;
	}

	function getEmail() {
		return $this->email;
	}

}