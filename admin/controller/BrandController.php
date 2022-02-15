<?php 
class BrandController {
	function list() {
		$page_title = "Thương hiệu";
		$brandRepository = new BrandRepository();
		$brands = $brandRepository->getAll();
		include "view/brand/list.php";
	}

	function add() {
		$page_title = "Thêm thương hiệu";
		include "view/brand/add.php";
	}

	function save() {
		$name = $_POST["name"];
		$data = [];
		$data["name"] = $name;
		$brandRepository = new BrandRepository();
		if ($brandRepository->save($data)) {
			$_SESSION["message"] = "Đã tạo nhãn hiệu thành công";
			header("location: index.php?c=brand");
			exit;
		}

		$_SESSION["error"] = $brandRepository->getError();
		header("location: index.php?c=brand");
	}

	function edit() {
		$page_title = "Cập nhật thương hiệu";
		$id = $_GET["id"];
		$brandRepository = new BrandRepository();
		$brand = $brandRepository->find($id);
		include "view/brand/edit.php";
	}

	function update() {
		$id = $_POST["id"];
		$name = $_POST["name"];
		$brandRepository = new BrandRepository();
		$brand = $brandRepository->find($id);
		$brand->setName($name);
		if ($brandRepository->update($brand)) {
			$_SESSION["message"] = "Đã update nhãn hiệu thành công";
			header("location: index.php?c=brand");
			exit;
		}
		$_SESSION["error"] = $brandRepository->getError();
		header("location: index.php?c=brand");
	}

	function delete() {
		$id = $_GET["id"];
		if ($this->remove($id)) {
			$_SESSION["message"] = "Đã xóa nhãn hiệu thành công";
			header("location: index.php?c=brand");
			exit;
		}

		$_SESSION["error"] = "Xóa thất bại";
		header("location: index.php?c=brand");
	}

	function remove($id) {
		$brandRepository = new BrandRepository();
		$brand = $brandRepository->find($id);
		if($brandRepository->delete($brand)) {
			return true;
		}
		echo $brandRepository->getError();
		return false;

	}

	function deletes() {
		$ids = $_POST["ids"];
		$flag = true;
		foreach ($ids as $id) {
			if (!$this->remove($id)) {
				$flag = false;
			}
		}

		if ($flag) {
			$_SESSION["message"] = "Đã xóa các nhãn hiệu thành công";
			header("location: index.php?c=brand");
			exit;
		}
		$_SESSION["error"] = "Xóa thất bại";
		header("location: index.php?c=brand");
	}

	function checkDelete(){
		$brand_id = $_GET["brand_id"];
		if ($this->canDelete($brand_id)) {
			echo json_encode(["can_delete" => 1, "message" => "OK"]);
		}
	}

	function checkDeletes() {
		$ids = $_GET["ids"];
		foreach ($ids as $id) {
			if (!$this->canDelete($id)) {
				return;
			}
		}
		echo json_encode(["can_delete" => 1, "message" => "OK"]);
	}

	function canDelete($brand_id) {
		$brandRepository = new BrandRepository();
		$brand = $brandRepository->find($brand_id);
		$products = $brand->getProducts();
		if (count($products) > 0) {
			//không xóa được
			echo json_encode(["can_delete" => 0, "message" => "Thương hiệu {$brand->getName()} có sản phẩm, không thể xóa"]);
			return false;
		}
		//xóa được
		return true;
	}
}