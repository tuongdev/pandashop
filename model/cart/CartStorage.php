<?php 
class CartStorage {
	function store($cart) {
		//serialize: chuyền object to string
		$_SESSION["cart"] = serialize($cart);
		setcookie("cart", serialize($cart),  time()+24*60*60);//keep one day
		
	
	}

	function fetch() {
		if (empty($_SESSION["cart"])) {
			if (empty($_COOKIE["cart"])) {
				$cart = new Cart();
				return $cart;
			}
			
			//update session;
			$_SESSION["cart"] = $_COOKIE["cart"];
			
		}
		//serialize: chuyền stirng to object
		$cart = unserialize($_SESSION["cart"]);
		
		return $cart;
	}

	function clear() {
		session_id() || session_start();
		unset($_SESSION["cart"]);
		setcookie("cart", null,  time()-24*60*60);//keep one day
	}
}
 ?>