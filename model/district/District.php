<?php
class District {
	protected $id;
	protected $name;
	protected $type;
	protected $province_id;

	function __construct($id, $name, $type, $province_id) {
		$this->id = $id;
		$this->name = $name;
		$this->type = $type;
		$this->province_id = $province_id;
	}

	function getId() {
		return $this->id;
	}

	function getName() {
		return $this->name;
	}

	function getType() {
		return $this->type;
	}

	function getProvinceId () {
		return $this->province_id;
	}
	
	function getProvince() {
		$provinceRepository = new ProvinceRepository();
		$province = $provinceRepository->find($this->province_id);
		return $province;
	}

	function getWards() {
		$wardRepository = new WardRepository();
		return $wardRepository->getByDistrictId($this->id);
	}
}