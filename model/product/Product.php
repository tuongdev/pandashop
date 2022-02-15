<?php 
class Product {
	protected $id;
	protected $name;
	protected $barcode;
	protected $sku;
	protected $price;
	protected $discount_percentage;
	protected $discount_from_date;
	protected $discount_to_date;
	protected $sale_price;
	protected $featured_image;
	protected $inventory_qty;
	protected $created_date;
	protected $description;
	protected $star;
	protected $featured;
	protected $category_id;
	protected $brand_id;

	function __construct($id, $name, $barcode, $sku,
		$price, $discount_percentage, $discount_from_date, 
		$discount_to_date, $sale_price,  $featured_image, 
		$inventory_qty, $created_date, $description, 
		$star, $featured, $category_id, $brand_id){

		$this->id = $id;
		$this->name = $name;
		$this->barcode = $barcode;
		$this->sku = $sku;
		$this->price = $price;
		$this->discount_percentage = $discount_percentage;
		$this->discount_from_date = $discount_from_date;
		$this->discount_to_date = $discount_to_date;
		$this->sale_price = $sale_price;
		$this->featured_image = $featured_image;
		$this->inventory_qty = $inventory_qty;
		$this->created_date = $created_date;
		$this->description = $description;
		$this->star = $star;
		$this->featured = $featured;
		$this->category_id = $category_id;
		$this->brand_id = $brand_id;
	}

	function getId() {
		return $this->id;
	}

	function getName() {
		return $this->name;
	}

	function getBarcode() {
		return $this->barcode;
	}

	function getSku() {
		return $this->sku;
	}

	function getPrice() {
		return $this->price;
	}

	function getDiscountPercentage() {
		return $this->discount_percentage;
	}

	function getDiscountFromDate() {
		return $this->discount_from_date;
	}

	function getDiscountToDate() {
		return $this->discount_to_date;
	}

	function getSalePrice() {
		return $this->sale_price;
	}

	function getFeaturedImage() {
		return $this->featured_image;
	}

	function getInventoryQty() {
		return $this->inventory_qty;
	}

	function getCreatedDate() {
		return $this->created_date;
	}

	function getDescription() {
		return $this->description;
	}

	function getStar() {
		return $this->star;
	}

	function getFeatured() {
		return $this->featured;
	}

	function getCategoryId() {
		return $this->category_id;
	}

	function getBrandId() {
		return $this->brand_id;
	}

	function setName($name) {
		$this->name = $name;
		return $this;
	}

	function setBarcode($barcode) {
		$this->barcode = $barcode;
		return $this;
	}

	function setSku($sku) {
		$this->sku = $sku;
		return $this;
	}

	function setPrice($price) {
		$this->price = $price;
		return $this;
	}

	function setDiscountPercentage($discount_percentage) {
		$this->discount_percentage = $discount_percentage;
		return $this;
	}

	function setDiscountFromDate($discount_from_date) {
		$this->discount_from_date = $discount_from_date;
		return $this;
	}

	function setDiscountToDate($discount_to_date) {
		$this->discount_to_date = $discount_to_date;
		return $this;
	}

	function setSalePrice($sale_price) {
		$this->sale_price = $sale_price;
		return $this;
	}

	function setFeaturedImage($featured_image) {
		$this->featured_image = $featured_image;
		return $this;
	}

	function setInventoryQty($inventory_qty) {
		$this->inventory_qty = $inventory_qty;
		return $this;
	}

	function setCreatedDate($created_date) {
		$this->created_date = $created_date;
		return $this;
	}

	function setDescription($description) {
		$this->description = $description;
		return $this;
	}

	function setStar($star) {
		$this->star = $star;
		return $this;
	}

	function setFeatured($featured) {
		$this->featured = $featured;
		return $this;
	}

	function setCategoryId($category_id) {
		$this->category_id = $category_id;
		return $this;
	}

	function setBrandId($brand_id) {
		$this->brand_id = $brand_id;
		return $this;
	}

	function getCategory() {
		$categoryRepository = new CategoryRepository();
		$category = $categoryRepository->find($this->category_id);
		return $category;

	}

	function getBrand() {
		$brandRepository = new BrandRepository();
		$brand = $brandRepository->find($this->brand_id);
		return $brand;

	}

	function getImageItems() {
		$imageItemRepository = new ImageItemRepository();
		$imageItems = $imageItemRepository->getByProductId($this->id);
		return $imageItems;
	}

	function getComments() {
		$commentRepository = new CommentRepository();
		$comments = $commentRepository->getByProductId($this->id);
		return $comments;
	}
}
