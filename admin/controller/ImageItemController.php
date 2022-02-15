<?php 
class ImageItemController {
	function list() {
		$page_title = "Hình ảnh của sản phẩm";
		$productRepository = new ProductRepository();
		$products = $productRepository->getAll();
		include "view/imageItem/list.php";
	}

	function detail() {
		//Liệt kê những hình ảnh chụp ở những khía cạnh khác nhau của product
		$id = $_GET["id"];
		$product_id = $id;
		$productRepository = new ProductRepository();
		$product = $productRepository->find($id);
		include "view/imageItem/detail.php";
	}

	function delete(){
		$id = $_GET["id"];
		$product_id = $_GET["product_id"];
		if ($this->remove($id)) {
			header("location: index.php?c=imageItem&a=detail&id=$product_id");
		}
		
	}

	function save(){
		$product_id = $_GET["id"];
		if (!empty($_FILES["image"]["name"]) && 
			$_FILES["image"]["error"] == 0) {
			$imageService = new ImageService();
			$correctFileName = $imageService->getCorrectImage($_FILES["image"]["name"]);
			$data = [];
			$data["name"] = $correctFileName;
			$data["product_id"] = $product_id;
			$imageItemRepository = new ImageItemRepository();
			if ($imageItemRepository->save($data)) {
				//Move file vào upload
				$newFile = "../upload/" . $correctFileName;
				move_uploaded_file($_FILES["image"]["tmp_name"], $newFile);

				header("location: index.php?c=imageItem&a=detail&id=$product_id");
				exit();
			}
			echo $imageItemRepository->getError();
			exit();
		}

		var_dump($_FILES);

	}

	function deletes() {
		$ids = $_POST["ids"];
		$product_id = $_POST["product_id"];
		$flag = true;
		foreach ($ids as $id) {
			if (!$this->remove($id)) {
				$flag = false;
			}
		}

		if ($flag) {
			header("location: index.php?c=imageItem&a=detail&id=$product_id");
		}
	}

	function remove($id) {
		$imageItemRepository = new ImageItemRepository();
		$imageItem = $imageItemRepository->find($id);
		$filename = $imageItem->getName();
		if($imageItemRepository->delete($imageItem)) {
			$removedPath = "../upload/$filename";
			if (file_exists($removedPath)) {
				unlink($removedPath);
			}
			return true;
		}
		echo $imageItemRepository->getError();
		return false;

	}
}