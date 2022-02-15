<?php 
class CommentController {
	function list() {
		$page_title = "Đánh giá sản phẩm";
		$productRepository = new ProductRepository();
		$products = $productRepository->getAll();
		include "view/comment/list.php";
	}

	function detail() {
		//Liệt kê những hình ảnh chụp ở những khía cạnh khác nhau của product
		$id = $_GET["id"];
		$product_id = $id;
		$productRepository = new ProductRepository();
		$product = $productRepository->find($id);
		include "view/comment/detail.php";
	}

	function delete() {
		$id = $_GET["id"];
		$product_id = $_GET["product_id"];
		if ($this->remove($id)) {
			header("location: index.php?c=comment&a=detail&id=$product_id");
		}
	}

	function remove($id) {
		$commentRepository = new CommentRepository();
		$comment = $commentRepository->find($id);
		if($commentRepository->delete($comment)) {
			return true;
		}
		echo $commentRepository->getError();
		return false;

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
			header("location: index.php?c=comment&a=detail&id=$product_id");
		}
	}

	
}