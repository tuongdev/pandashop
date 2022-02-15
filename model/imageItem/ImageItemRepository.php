<?php
class ImageItemRepository{
	protected function fetchAll($condition = null)
	{
		global $conn;
		$imageItems = array();
		$sql = "SELECT * FROM image_item";
		if ($condition) 
		{
			$sql .= " WHERE  $condition";
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$imageItem = new ImageItem($row["id"], $row["name"], $row["product_id"]);
				$imageItems[] = $imageItem;
			}
		}

		return $imageItems;
	}

	function getAll() {
		return $this->fetchAll();
	}

	function getByProductId($product_id) {
		global $conn; 
		$condition = "product_id = $product_id";
		$imageItems = $this->fetchAll($condition);
		return $imageItems;
	}

	function find($id) {
		global $conn; 
		$condition = "id = $id";
		$imageItems = $this->fetchAll($condition);
		$imageItem = current($imageItems);
		return $imageItem;
	}

	function save($data) {
		global $conn;
		$name = $data["name"];
		$product_id = $data["product_id"];
		$sql = "INSERT INTO image_item (name, product_id) VALUES ('$name', $product_id)";
		if ($conn->query($sql) === TRUE) {
			return true;
		} 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function update(ImageItem $imageItem) {
		global $conn;
		$name = $imageItem->getName();
		$id = $imageItem->getId();
		$product_id = $imageItem->getProductId();
		$sql = "UPDATE image_item SET name='$name', product_id=$product_id WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete(ImageItem $imageItem) {
		global $conn;
		$id = $imageItem->getId();
		$sql = "DELETE FROM image_item WHERE id=$id";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}
}