<?php 
class DashboardController {
	function list() {
		// var_dump($_GET);
		$orderRepository = new OrderRepository();
		$from_date = (!empty($_GET["from_date"]) ? $_GET["from_date"]: date("Y-m-d")) . " 00:00:00";
		$to_date = (!empty($_GET["to_date"]) ? $_GET["to_date"]: date("Y-m-d")) . " 23:59:59";

		$conds = [
			"created_date" => [
				"type" => "BETWEEN",
				"val" => "'$from_date' AND '$to_date'",
			]
		];

		//SELECT * order WHERE created_date BETWEEN '2020-01-01' AND '2020-12-30'

		$orders = $orderRepository->getBy($conds);
		include "view/dashboard/list.php";
	}
}
?>