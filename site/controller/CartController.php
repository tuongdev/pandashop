<?php
class CartController
{
	protected $cartStorage;
	function __construct()
	{
		$this->cartStorage = new CartStorage();
	}
	function display()
	{
		$cart = $this->cartStorage->fetch();
		echo json_encode($cart->convertToArray());
	}

	function add()
	{
		$product_id = $_GET["product_id"];
		$qty = $_GET["qty"];
		$cart = $this->cartStorage->fetch();
		
		$cart->addProduct($product_id, $qty);
		$this->cartStorage->store($cart);
		
		//Đổi đối tượng -> chuỗi
		//Đổi tượng thành array, sau đó từ array -> chuỗi
		echo json_encode($cart->convertToArray());
		
	}

	function update()
	{
		$product_id = $_GET["product_id"];
		$qty = $_GET["qty"];
		$cart = $this->cartStorage->fetch();

		$cart->deleteProduct($product_id);
		$cart->addProduct($product_id, $qty);

		$this->cartStorage->store($cart);

		echo json_encode($cart->convertToArray());
	}

	function delete()
	{
		$product_id = $_GET["product_id"];
		$cart = $this->cartStorage->fetch();

		$cart->deleteProduct($product_id);

		$this->cartStorage->store($cart);
				
		echo json_encode($cart->convertToArray());
	}
}
