<?php
class Province {
	protected $id;
	protected $name;
	protected $type;

	function __construct($id, $name, $type) {
		$this->id = $id;
		$this->name = $name;
		$this->type = $type;
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

	function getDistricts() {
		$districtRepository = new DistrictRepository();
		return $districtRepository->getByProvinceId($this->id);
	}

	function getShippingFee() {
		$tranportRepository = new TransportRepository();
		$trasport = $tranportRepository->findByProvinceId($this->id);
		$shipping_fee = $trasport->getPrice();
		return $shipping_fee;
	}
	
}