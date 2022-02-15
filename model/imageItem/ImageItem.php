<?php 
class ImageItem
{
	protected $id;
	protected $name;
	protected $product_id;

	function __construct($id, $name, $product_id){
		$this->id = $id;
		$this->name = $name;
		$this->product_id = $product_id;
	}

	function getId(){
		return $this->id;
	}

	function getName(){
		return $this->name;
	}

	function getProductId() {
		return $this->product_id;
	}

	function setName($name){
		$this->name = $name;
		return $this;
	}

	function setProductId($product_id) {
		$this->product_id = $product_id;
		return $this;
	}
}