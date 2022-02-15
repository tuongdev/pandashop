<?php 
class Transport
{
	protected $id;
	protected $price;
	protected $province_id;

	function __construct($id, $province_id, $price){
		$this->id = $id;
		$this->province_id = $province_id;
		$this->price = $price;
	}

	function getId(){
		return $this->id;
	}

	function getPrice(){
		return $this->price;
	}

	function getProvinceId(){
		return $this->province_id;
	}

	function setPrice($price){
		$this->price = $price;
		return $this;
	}

	function getProvince() {
		$provinceRepository = new ProvinceRepository();
		$province = $provinceRepository->find($this->province_id);
		return $province;
	}


}