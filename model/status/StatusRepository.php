<?php
class StatusRepository {
	protected $error;

	protected function fetchAll($condition = null)
	{
		global $conn;
		$statuses = array();
		$sql = "SELECT * FROM status";
		if ($condition) 
		{
			$sql .= " WHERE $condition";
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$status = new Status($row["id"], $row["name"], $row["description"]);
				$statuses[] = $status;
			}
		}

		return $statuses; // This is array 
	}

	function getAll() {
		return $this->fetchAll();
	}

	function find($id) {
		global $conn; 
		$condition = "id = $id";
		$statuses = $this->fetchAll($condition);
		$status = current($statuses);
		return $status;
	}

	function update($status) {
		global $conn;
		$id = $status->getId();
		$name = $status->getName();
		$description = $status->getDescription();
		$sql = "UPDATE status SET name='$name', description='$description'  WHERE id=$id";

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