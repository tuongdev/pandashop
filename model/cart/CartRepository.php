<?php 
class CartRepository {
    function fetchAll($condition = null) {
        global $conn;
		$carts = array();
		$sql = "SELECT * FROM cart";
		if ($condition) 
		{
			$sql .= " WHERE  $condition";
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
                $cart = new Cart($row['id'],$row['product_id'],$row['name'],$row['img'],$row['qty'],$row['unit_price'],$row['total_price']);
				$carts[] = $cart;
			}
		}
		return $carts;
      
    }
    function getAll() {
		return $this->fetchAll();
	}
    function save($data) {
		global $conn;
		$name = $data["name"];
		$sql = "INSERT INTO brand (name) VALUES ('$name')";
		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;//chỉ cho auto increment
		    return $last_id;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}
}
?>