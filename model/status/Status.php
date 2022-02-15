<?php
class Status  {
	protected $id;
	protected $name;
	protected $description;

	function __construct($id, $name, $description) {
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
	}

	function getId() {
		return $this->id;
	}

	function getName() {
		return $this->name;
	}

	function getDescription() {
		return $this->description;
	}

	function setId($id) {
		$this->id = $id;
		return $this;
	}

	function setName($name) {
		$this->name = $name;
		return $this;
	}

	function setDescription($description) {
		$this->description = $description;
		return $this;
	}
}