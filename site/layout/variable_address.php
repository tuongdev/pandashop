<?php 
//Tổng cộng 6 cái:
// $provinces, $districts, $wards
// $selected_province_id, $selected_district_id, $selected_ward_id
$provinceRepository = new ProvinceRepository();
$provinces = $provinceRepository->getAll();//1 provinces
$districts = [];
$wards = [];
$selected_ward = $customer->getWard();
$selected_province_id = null;
$selected_district_id = null;
$selected_ward_id = null;    
$shipping_fee = 0;
if (!empty($selected_ward)) {
    $selected_ward_id = $selected_ward->getId();// 2 selected_ward_id
    $selected_district = $selected_ward->getDistrict();
    $selected_district_id = $selected_district->getId();//3 selected_district_id
    $selected_province = $selected_district->getProvince();
    $selected_province_id = $selected_province->getId(); //4 selected_province_id
    $districts = $selected_province->getDistricts(); // 5 districts
    $wards =  $selected_district->getWards(); //6 wards
    $shipping_fee = $selected_province->getShippingFee();
}
 ?>