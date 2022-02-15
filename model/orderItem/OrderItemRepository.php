<?php
class OrderItemRepository{
	protected function fetchAll($condition = null)
	{
		global $conn;
		$orderItems = array();
		$sql = "SELECT * FROM order_item";
		if ($condition) 
		{
			$sql .= " WHERE  $condition";
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$orderItem = new OrderItem($row["product_id"], $row["order_id"], $row["qty"], $row["unit_price"], $row["total_price"]);
				$orderItems[] = $orderItem;
			}
		}

		return $orderItems;
	}

	function getAll() {
		return $this->fetchAll();
	}

	function getByOrderId($order_id) {
		global $conn; 
		$condition = "order_id = $order_id";
		$orderItems = $this->fetchAll($condition);
		return $orderItems;
	}

	function find($order_id, $product_id) {
		global $conn; 
		$condition = "order_id = $order_id AND product_id = $product_id";
		$orderItems = $this->fetchAll($condition);
		$orderItem = current($orderItems);
		return $orderItem;
	}

	function save($data) {
		global $conn;
		$product_id = $data["product_id"]; 
		$order_id = $data["order_id"]; 
		$qty = $data["qty"];
		$unit_price = $data["unit_price"];
		$total_price = $data["total_price"];
		$sql = "INSERT INTO order_item (product_id, order_id, qty, unit_price, total_price) VALUES ($product_id, $order_id, $qty, $unit_price, $total_price)";
		if ($conn->query($sql) === TRUE) {
			return true;
		} 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function update($orderItem) {
		global $conn;
		$product_id = $orderItem->getProductId();
		$order_id = $orderItem->getOrderId(); 
		$qty = $orderItem->getQty();
		$unit_price = $orderItem->getUnitPrice();
		$total_price = $orderItem->getTotalPrice();
		$sql = "UPDATE order_item SET 
			qty = $qty,
			unit_price = $unit_price,
			total_price = $total_price
			WHERE order_id = $order_id AND product_id = $product_id";

		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete($orderItem) {
		global $conn;
		$product_id = $orderItem->getProductId();
		$order_id = $orderItem->getOrderId();
		$sql = "DELETE FROM order_item WHERE order_id = $order_id AND product_id = $product_id";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}
}