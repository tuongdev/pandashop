<?php 
class ShippingFeeController {
	function list() {
		$page_title = "Phí giao hàng";
		$transportRepository = new TransportRepository();
		$transports = $transportRepository->getAll();
		include "view/shippingfee/list.php";
	}

	function edit() {
		$page_title = "Cập nhật phí giao hàng";
		$id = $_GET["id"];
		$transportRepository = new TransportRepository();
		$transport = $transportRepository->find($id);
		include "view/shippingfee/edit.php";
	}

	function update() {
		$id = $_POST["id"];
		$price = $_POST["price"];
		$transportRepository = new TransportRepository();
		$transport = $transportRepository->find($id);
		$transport->setPrice($price);
		if ($transportRepository->update($transport)) {
			header("location: index.php?c=shippingfee");
			exit;
		}

	}

	
}