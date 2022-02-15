<?php 
class AddressController {
    function getProvinces() {
		$provinceRepository = new ProvinceRepository();
		$provinces = $provinceRepository->getAll();
		echo json_encode($this->convertToAssociateArray($provinces));
	}

	function getDistricts() {
		$province_id = $_GET["province_id"];
		$districtRepository = new DistrictRepository();
		$districts = $districtRepository->getByProvinceId($province_id);
		echo json_encode($this->convertToAssociateArray($districts));
	}

	function getWards() {
		$district_id = $_GET["district_id"];
		$wardRepository = new WardRepository();
		$wards = $wardRepository->getByDistrictId($district_id);
		echo json_encode($this->convertToAssociateArray($wards));
	}
    
	function convertToAssociateArray($objects) {
		$array = array();
		foreach ($objects as $object) {
			$array[] = array("id" => $object->getId(), "name" => $object->getName());
		}
		return $array;
	}
	function getShippingFee() {
		$province_id = $_GET["province_id"];
		$provinceRepository = new ProvinceRepository();
		$province = $provinceRepository->find($province_id);
		echo $province->getShippingFee();
	}


}
?>