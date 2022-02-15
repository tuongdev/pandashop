<?php 
class OrderItem
{
	protected $product_id;
	protected $order_id;
	protected $qty;
	protected $unit_price;
	protected $total_price;

	function __construct($product_id, $order_id, $qty, $unit_price, $total_price){
		$this->product_id = $product_id;
		$this->order_id = $order_id;
		$this->qty = $qty;
		$this->unit_price = $unit_price;
		$this->total_price = $total_price;
	}

	function getProductId(){
		return $this->product_id;
	}

	function getOrderId(){
		return $this->order_id;
	}

	function getQty(){
		return $this->qty;
	}

	function getUnitPrice(){
		return $this->unit_price;
	}

	function getTotalPrice(){
		return $this->total_price;
	}

	function setProductId($product_id){
		$this->product_id = $product_id;
		return $this;
	}

	function setOrderId($order_id){
		$this->order_id = $order_id;
		return $this;
	}

	function setQty($qty){
		$this->qty = $qty;
		return $this;
	}

	function setUnitPrice($unit_price){
		$this->unit_price = $unit_price;
		return $this;
	}

	function setTotalPrice($total_price){
		$this->total_price = $total_price;
		return $this;
	}

	function getProduct() {
		$productRepository = new ProductRepository();
		$product = $productRepository->find($this->product_id);
		return $product;
	}

	function getOrder() {
		$orderRepository = new OrderRepository();
		$order = $orderRepository->find($this->order_id);
		return $order;
	}
}