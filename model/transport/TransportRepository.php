<?php
class TransportRepository{
	protected $error;

	protected function fetchAll($condition = null)
	{
		global $conn;
		$transports = array();
		$sql = "SELECT * FROM transport";
		if ($condition) 
		{
			$sql .= " WHERE $condition";
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$transport = new Transport($row["id"], $row["province_id"], $row["price"]);
				$transports[] = $transport;
			}
		}

		return $transports;
	}

	function getAll() {
		return $this->fetchAll();
	}

	function find($id) {
		global $conn; 
		$condition = "id = $id";
		$transports = $this->fetchAll($condition);
		$transport = current($transports);
		return $transport;
	}

	function findByProvinceId($province_id) {
		global $conn; 
		$condition = "province_id = '$province_id'";
		$transports = $this->fetchAll($condition);
		$transport = current($transports);
		return $transport;
	}

	function save($data) {
		global $conn;
		$province_id = $data["province_id"];
		$price = $data["price"];
		$sql = "INSERT INTO transport (province_id, price) VALUES ($province_id, $price)";
		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;//chỉ cho auto increment
		    return $last_id;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function update($transport) {
		global $conn;
		$id = $transport->getId();
		$price = $transport->getPrice();
		$province_id = $transport->getProvinceId();
		$sql = "UPDATE transport SET province_id=province_id, price=$price WHERE id=$id";
		
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete($transport) {
		global $conn;
		$id = $transport->getTransportId();
		$sql = "DELETE FROM transport WHERE id=$id";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function getError() {
		return $this->error;
	}
}