<?php
class ActionRepository extends BaseRepository{

	protected function fetchAll($condition = null)
	{
		global $conn;
		$actions = array();
		$sql = "SELECT * FROM action";
		if ($condition) 
		{
			$sql .= " WHERE $condition";
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$action = new action($row["id"], $row["name"], $row["description"]);
				$actions[] = $action;
			}
		}

		return $actions; // This is array 
	}

	function getAll() {
		return $this->fetchAll();
	}

	function find($id) {
		global $conn; 
		$condition = "id = $id";
		$actions = $this->fetchAll($condition);
		$action = current($actions);
		return $action;
	}

	function findByName($name) {
		global $conn; 
		$condition = "name = '$name'";
		$actions = $this->fetchAll($condition);
		$action = current($actions);
		return $action;
	}

	function update($action) {
		global $conn;
		$name = $action->getName();
		$id = $action->getId();
		$description = $action->getDescription();
		$sql = "UPDATE action SET name='$name', description='$description' WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}
}