<?php
class ProductRepository extends BaseRepository{

	protected function fetchAll($condition = null, $sort = null, $limit = null)
	{
		global $conn;
		$products = array();
		
		$sql = "SELECT * FROM view_product";
		if ($condition) 
		{
			$sql .= " WHERE $condition"; //SELECT * FROM view_product WHERE name LIKE '%abc%'  AND create_date='2020-08-07'
		}

		if ($sort) {
			//SELECT * FROM view_product WHERE name LIKE '%abc%'  AND create_date='2020-08-07' ORDER BY name asc, created_date desc
			$sql .= " $sort";
		}

		if ($limit) 
		{	
			$sql .= " $limit";
			//SELECT * FROM view_product WHERE name LIKE '%abc%'  AND create_date='2020-08-07' ORDER BY name asc, created_date desc LIMIT 20, 10
		}
		// echo $sql;
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$product = new Product(
					$row["id"], $row["name"], $row["barcode"],
					$row["sku"], $row["price"], $row["discount_percentage"], 
					$row["discount_from_date"], $row["discount_to_date"],
					$row["sale_price"], $row["featured_image"], $row["inventory_qty"], 
					$row["created_date"], $row["description"], $row["star"], $row["featured"], 
					$row["category_id"], $row["brand_id"]);
				$products[] = $product;
			}
		}

		return $products;
	}

	function getAll() {
		return $this->getBy();
	}
	
	// $array_conds: lấy sản phẩm dựa theo cột
	// $array_sorts: sắp xếp tăng hay giảm
	// $page: trang thứ mấy
	// $qty_per_page: số lượng sản phẩm mỗi trang
	function getBy($array_conds = array(), $array_sorts = array(), $page = null, $qty_per_page = null) {
		if ($page) {
			$page_index = $page - 1;
		}
		
		$temp = array();
		foreach($array_conds as $column => $cond) {
			$type = $cond['type'];
			$val = $cond['val'];
			$str = "$column $type ";
			if (in_array($type, array("BETWEEN", "LIKE"))) {
				$str .= "$val"; //name LIKE '%abc%'
			}
			else {
				$str .= "'$val'";
			}
			$temp[] = $str;
		}
		$condition = null;

		if (count($array_conds)) {
			//name LIKE '%abc%' 
			//create_date='2020-08-07'
			// => name LIKE '%abc%'  AND create_date='2020-08-07'
			$condition = implode(" AND ", $temp);
		}
		
		$temp = array();
		foreach($array_sorts as $key => $sort) {
			$temp[] = "$key $sort";
		}
		$sort = null;

		if (count($array_sorts)) {
			//name asc
			//created_date desc 
			//=> ORDER BY name asc, created_date desc 
			$sort = "ORDER BY ". implode(" , ", $temp);
		}

		$limit = null;
		//Trang 3, lấy 10 phần tử
		//LIMIT 20, 10
		if ($qty_per_page) {
			$start = $page_index * $qty_per_page;
			$limit = "LIMIT $start, $qty_per_page";
		}
		

		return $this->fetchAll($condition, $sort, $limit);
	}

	function find($id) {
		global $conn; 
		$condition = "id = $id";
		$products = $this->fetchAll($condition);
		$product = current($products);
		return $product;
	}

	function findByBarcode($barcode) {
		global $conn; 
		$condition = "barcode = '$barcode'";
		$products = $this->fetchAll($condition);
		$product = current($products);
		return $product;
	}

	function save($data) {
		global $conn;
		$name = $data["name"];
		$barcode = $data["barcode"];
		$sku = $data["sku"];
		$price = $data["price"];
		$discount_percentage = $data["discount_percentage"];
		$discount_from_date = $data["discount_from_date"];
		$discount_to_date = $data["discount_to_date"];
		$featured_image = $data["featured_image"];
		$inventory_qty = $data["inventory_qty"];
		$created_date = $data["created_date"];
		$description = $data["description"];
		$featured = $data["featured"];
		$category_id = $data["category_id"];
		$brand_id = $data["brand_id"];
		$sql = "INSERT INTO product (name, barcode,sku,
		price, discount_percentage, discount_from_date, discount_to_date, featured_image, inventory_qty, created_date,
		description, featured, category_id, brand_id) 
		VALUES ('$name', '$barcode', '$sku' ,$price, '$discount_percentage', '$discount_from_date', '$discount_to_date',  '$featured_image', '$inventory_qty', '$created_date', '$description', '$featured', $category_id, $brand_id)";
		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;//chỉ cho auto increment
		    return $last_id;
		} 
		$this->error =  "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function update(Product $product) {
		global $conn;
		
		$id = $product->getId();
		$name = $product->getName();
		$sku = $product->getSku();
		$barcode = $product->getBarcode();
		$price = $product->getPrice();
		$discount_percentage = $product->getDiscountPercentage();
		$discount_from_date = $product->getDiscountFromDate();
		$discount_to_date = $product->getDiscountToDate();
		$featured_image = $product->getFeaturedImage();
		$inventory_qty = $product->getInventoryQty();
		$created_date = $product->getCreatedDate();
		$description = $product->getDescription();
		$star = $product->getStar();
		$featured = $product->getFeatured();
		$category_id = $product->getCategoryId();
		$brand_id = $product->getBrandId();
		$sql = "UPDATE product SET 
			name='$name',
			barcode='$barcode',
			sku='$sku',
			price=$price,
			discount_percentage=$discount_percentage,
			discount_from_date='$discount_from_date',
			discount_to_date='$discount_to_date',
			featured_image='$featured_image',
			inventory_qty='$inventory_qty',
			created_date='$created_date',
			description='$description',
			star='$star',
			featured='$featured',
			category_id=$category_id,
			brand_id=$brand_id
			WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error =  "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete(Product $product) {
		global $conn;
		$id = $product->getId();
		$sql = "DELETE FROM product WHERE id=$id";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error =  "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function getByPattern($pattern) {
		$condition = "name like '%$pattern%'";
		return $this->fetchAll($condition);
	}
}