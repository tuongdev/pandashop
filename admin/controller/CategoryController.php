<?php 
class CategoryController {
	function list() {
		$page_title = "Danh mục";
		$categoryRepository = new CategoryRepository();
		$categories = $categoryRepository->getAll();
		include "view/category/list.php";
	}

	function add() {
		$page_title = "Thêm danh mục";
		include "view/category/add.php";
	}

	function save() {
		$name = $_POST["name"];
		$data = [];
		$data["name"] = $name;
		$categoryRepository = new CategoryRepository();
		if ($categoryRepository->save($data)) {
			header("location: index.php?c=category");
			exit;
		}
	}

	function edit() {
		$page_title = "Cập nhật danh mục";
		$id = $_GET["id"];
		$categoryRepository = new CategoryRepository();
		$category = $categoryRepository->find($id);
		include "view/category/edit.php";
	}

	function update() {
		$id = $_POST["id"];
		$name = $_POST["name"];
		$categoryRepository = new CategoryRepository();
		$category = $categoryRepository->find($id);
		$category->setName($name);
		if ($categoryRepository->update($category)) {
			header("location: index.php?c=category");
			exit;
		}

	}

	function delete() {
		$id = $_GET["id"];
		if ($this->remove($id)) {
			header("location: index.php?c=category");
		}
	}

	function remove($id) {
		$categoryRepository = new CategoryRepository();
		$category = $categoryRepository->find($id);
		if($categoryRepository->delete($category)) {
			return true;
		}
		echo $categoryRepository->getError();
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
			header("location: index.php?c=category");
		}
	}

	function checkDelete(){
		$category_id = $_GET["category_id"];
		$categoryRepository = new CategoryRepository();
		$category = $categoryRepository->find($category_id);
		$products = $category->getProducts();
		if (count($products) > 0) {
			//không xóa được
			echo json_encode(["can_delete" => 0, "message" => "Danh mục {$category->getName()} có sản phẩm, không thể xóa"]);
			return;
		}
		//xóa được
		echo json_encode(["can_delete" => 1, "message" => "OK"]);
		return;

	}
}