<?php 
class StatusController {
	function list() {
		$page_title = "Trạng thái đơn hàng";
		$statusRepository = new StatusRepository();
		$statuses = $statusRepository->getAll();
		include "view/status/list.php";
	}

	function edit() {
		$page_title = "Cập nhật trạng thái đơn hàng";
		$id = $_GET["id"];
		$statusRepository = new StatusRepository();
		$status = $statusRepository->find($id);
		include "view/status/edit.php";
	}

	function update() {
		$id = $_POST["id"];
		$description = $_POST["description"];
		$statusRepository = new StatusRepository();
		$status = $statusRepository->find($id);
		$status->setDescription($description);
		if ($statusRepository->update($status)) {
			header("location: index.php?c=status");
			exit();
		}
	}
}