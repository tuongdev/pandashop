<?php 
class Brand
{
	protected $id;
	protected $name;

	function __construct($id, $name){
		$this->id = $id;
		$this->name = $name;
	}

	function getId(){
		return $this->id;
	}

	function getName(){
		return $this->name;
	}

	function setName($name){
		$this->name = $name;
		return $this;
	}

	function getProducts() {
		$productRepository = new ProductRepository();
		$conds = [
			"brand_id" => [
				"type" => "=", 
				"val" => $this->id
			]
		];
		$products = $productRepository->getBy($conds);
		return $products;
	}

}