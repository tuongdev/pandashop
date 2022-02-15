<?php 
class ProductController {
	function list() {
		$page_title = "Danh sách sản phẩm";
		$productRepository = new ProductRepository();
		$products = $productRepository->getAll();
		include "view/product/list.php";
	}

	function add() {
		$categoryRepository = new CategoryRepository();
		$categories = $categoryRepository->getAll();

		$brandRepository = new BrandRepository();
		$brands = $brandRepository->getAll();

		include "view/product/add.php";
	}

	function edit() {
		$id = $_GET["id"];
		$productRepository = new ProductRepository();
		$product = $productRepository->find($id);

		$categoryRepository = new CategoryRepository();
		$categories = $categoryRepository->getAll();

		$brandRepository = new BrandRepository();
		$brands = $brandRepository->getAll();

		include "view/product/edit.php";
	}

	function save(){
		$imageService = new ImageService();
		$filename = $imageService->getCorrectImage($_FILES["image"]["name"]);
		$data = [];
		$data["name"]					=$_POST["name"];
		$data["barcode"]				=$_POST["barcode"];
		$data["sku"]					=$_POST["sku"];
		$data["price"]					=$_POST["price"];
		$data["discount_percentage"]	=$_POST["discount_percentage"];
		$data["discount_from_date"]		=$_POST["discount_from_date"];
		$data["discount_to_date"]		=$_POST["discount_to_date"];
		$data["featured_image"]			=$filename;
		$data["inventory_qty"]			=$_POST["inventory_qty"];
		$data["created_date"]			= date("Y-m-d");
		$data["description"]			=$_POST["description"];
		$data["featured"]				=$_POST["featured"];
		$data["category_id"]			=$_POST["category"];
		$data["brand_id"]				=$_POST["brand"];

		$productRepository = new ProductRepository();
		if($productRepository->save($data)) {
			$src = $_FILES["image"]["tmp_name"];
			$des = "../upload/$filename";
			move_uploaded_file($src, $des);
			header("location: index.php?c=product");
			exit();
		}
		echo $productRepository->getError();

	}

	function delete() {
		$id = $_GET["id"];
		$productRepository = new ProductRepository();
		$product = $productRepository->find($id);
		$file = "../upload/" . $product->getFeaturedImage();
		unlink($file);
		if($productRepository->delete($product)) {
			header("location: index.php?c=product");
			exit();
		}

	}

	function update() {
		//var_dump($_FILES);
		$id = $_POST["id"];
		$productRepository = new ProductRepository();
		$product = $productRepository->find($id);
		//set giá trị mới
		$product->setBarCode($_POST["barcode"]);
		$product->setName($_POST["name"]);
		$product->setSku($_POST["sku"]);
		$product->setPrice($_POST["price"]);
		$product->setDiscountPercentage($_POST["discount_percentage"]);
		$product->setDiscountFromDate($_POST["discount_from_date"]);
		$product->setDiscountToDate($_POST["discount_to_date"]);
		$product->setInventoryQty($_POST["inventory_qty"]);
		$product->setFeatured($_POST["featured"]);
		$product->setCategoryId($_POST["category"]);
		$product->setBrandId($_POST["brand"]);
		$product->setDescription($_POST["description"]);

		if (!empty($_FILES["image"]["name"]) && 
			$_FILES["image"]["error"] == 0) {
			// 1. Delete hình trước
			$oldFile = "../upload/" . $product->getFeaturedImage();
			if (file_exists($oldFile)) {
				unlink($oldFile);
			}

			// 2. Move hình mới vô
			$imageService = new ImageService();
			$correctFileName = $imageService->getCorrectImage($_FILES["image"]["name"]);
			$newFile = "../upload/" . $correctFileName;
			move_uploaded_file($_FILES["image"]["tmp_name"], $newFile);

			// 3. Cập nhật setFeaturedImage để lưu xuống database là tên mới
			$product->setFeaturedImage($correctFileName);
		}

		if ($productRepository->update($product)) {
			header("location: index.php?c=product");
			exit();
		}
		echo $productRepository->getError();
	}

	
	function findBarcode() {
		$barcode = $_GET["barcode"];
		$productRepository = new ProductRepository();
		$product = $productRepository->findByBarcode($barcode);
		if (empty($product)) {
			return;
		}

		$data = array(
			"id" => $product->getId(),
			"barcode" => $product->getBarcode(),
			"featured_image" => $product->getFeaturedImage(),
			"name" => $product->getName(),
			"price" => $product->getPrice(),
			"sale_price" => $product->getSalePrice(),
			"discount_percentage" => $product->getDiscountPercentage(),
		);
		echo json_encode($data);
	}
	

	

	
}
?>