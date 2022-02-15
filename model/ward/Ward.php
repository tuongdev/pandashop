<?php
class Ward {
	protected $id;
	protected $name;
	protected $type;
	protected $district;

	function __construct($id, $name, $type, $district_id) {
		$this->id = $id;
		$this->name = $name;
		$this->type = $type;
		$this->district_id = $district_id;
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

	function getDistrictId() {
		return $this->district_id;
	}

	function getDistrict() {
		$districtRepository = new DistrictRepository();
		$district = $districtRepository->find($this->district_id);
		return $district;
	}
}