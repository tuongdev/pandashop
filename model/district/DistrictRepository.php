<?php
class DistrictRepository {

	protected function fetchAll($condition = null, $order = null)
	{
		global $conn;
		$districts = array();
		$sql = "SELECT * FROM district";
		if ($condition) 
		{
			$sql .= " WHERE $condition";
		}

		if ($order) {
			$sql .= " ORDER BY $order";
		}
		$result = $conn->query($sql);
		// echo $sql;
		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$district = new District($row["id"], $row["name"], $row["type"], $row["province_id"]);
				$districts[] = $district;
			}
		}

		return $districts; // This is array 
	}

	function getAll() {
		return $this->fetchAll();
	}

	function find($id) {
		global $conn; 
		$condition = "id = '$id'";
		$districts = $this->fetchAll($condition);
		$district = current($districts);
		return $district;
	}

	function getByProvinceId($province_id) {
		global $conn; 
		$condition = "province_id = '$province_id'";
		return $this->fetchAll($condition, "name ASC");
	}
}