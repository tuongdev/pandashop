<?php 
class OrderController {
	function list() {
		$page_title = "Danh sách đơn hàng";
		$orderRepository = new OrderRepository();
		$orders = $orderRepository->getAll();
		include "view/order/list.php";
	}

	function add() {
		$page_title = "Tạo đơn hàng";
		$customerRepository = new CustomerRepository();
		$customers = $customerRepository->getAll();

		$statusRepository = new StatusRepository();
		$statuses = $statusRepository->getAll();

		$provinceRepository = new ProvinceRepository();
		$provinces = $provinceRepository->getAll();

		$staffRepository = new StaffRepository();
		$staffs = $staffRepository->getAll();
		
		include "view/order/add.php";
	}

	function save() {
		//Create order

		$data = array();
		$data["created_date"] = date("Y-m-d H:m:s");
		$data["order_status_id"] = $_POST["status"];
		$data["staff_id"] = $_POST["staff"];
		$data["customer_id"] = $_POST["customer"];
		$data["shipping_fullname"] = $_POST["shipping_name"];
		$data["shipping_mobile"] = $_POST["shipping_mobile"];
		$data["payment_method"] = $_POST["payment_method"]; 
		$data["shipping_ward_id"] = $_POST["ward"]; 
		$data["shipping_housenumber_street"] = $_POST["housenumber_street"]; 
		$data["shipping_fee"] = $_POST["shipping_fee"]; 
		$data["delivered_date"] = $_POST["delivered_date"];
		$orderRepository = new OrderRepository();
		$productRepository = new ProductRepository();
		if ($order_id = $orderRepository->save($data)) {
			$product_ids = $_POST["product_ids"];
			$qties = $_POST["qties"];

			//save into order detail
			$orderDetailRepository = new OrderItemRepository();
			for ($i=0; $i <= count($product_ids) - 1; $i++) {
				$detail_data = array();
				$detail_data["order_id"] = $order_id;
				$detail_data["product_id"] = $product_ids[$i];
				$detail_data["qty"] = $qties[$i];

				$product = $productRepository->find($product_ids[$i]);
				$detail_data["unit_price"] = $product->getSalePrice();
				$detail_data["total_price"] = $product->getSalePrice() * $qties[$i];

				if(!$orderDetailRepository->save($detail_data)) {
					exit();
				}

			}
			
			header("location:index.php?c=order");
			exit;
		}
	}

	function ajaxGetShippingInfoDefault() {
		$customer_id = $_GET["customer_id"];
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->find($customer_id);

		$provinceRepository = new ProvinceRepository();
		$provinces = $provinceRepository->getAll();
		$data = [];
		$data["shipping_name"] = $customer->getShippingName();
		$data["shipping_mobile"] = $customer->getShippingMobile();
		$data["housenumber_street"] = $customer->getHousenumberStreet();
		$data["provinces"] = [];
		$data["districts"] = [];
		$data["wards"] = [];
		if (!empty($customer->getWardId())) {
			$data["selected_ward_id"] = $customer->getWardId();

			$ward = $customer->getWard();
			$data["selected_district_id"] = $ward->getDistrictId();

			$district = $ward->getDistrict();
			$data["selected_province_id"] = $district->getProvinceId();

			$province = $district->getProvince();

			$wards = $district->getWards();
			foreach ($wards as $w) {
				$data["wards"][] = ["id" => $w->getId(), "name" => $w->getName()];
			}

			$districts = $province->getDistricts();  

			foreach ($districts as $d) {
				$data["districts"][] = ["id" => $d->getId(), "name" => $d->getName()];
			}
		}

		foreach ($provinces as $p) {
			$data["provinces"][] = ["id" => $p->getId(), "name" => $p->getName()];
		}
		echo json_encode($data);
	}

	function delete() {
		$order_id = $_GET["order_id"];
		$orderRepository = new OrderRepository();
		$order = $orderRepository->find($order_id);
		if ($orderRepository->delete($order)) {
			header("location: index.php?c=order");
			exit;
		}
	}

	function confirm(){
		$order_id = $_GET["order_id"];
		$orderRepository = new OrderRepository();
		$order = $orderRepository->find($order_id);
		$order->setStatusId(2);//xác nhận đơn hàng
		$staffRepository = new StaffRepository();
		$staff = $staffRepository->findUsername($_SESSION["username"]);
		$staff_id = $staff->getId();
		$order->setStaffId($staff_id);//người xác nhận là người có trách nhiệm trên đơn hàng
		if ($orderRepository->update($order)) {
			header("location: index.php?c=order");
			exit;
		}
	}
}
?>