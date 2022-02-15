<?php
class WardRepository {

	protected function fetchAll($condition = null, $order = null)
	{
		global $conn;
		$wards = array();
		$sql = "SELECT * FROM ward";
		if ($condition) 
		{
			$sql .= " WHERE $condition";
		}

		if ($order) {
			$sql .= " ORDER BY $order";
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$ward = new Ward($row["id"], $row["name"], $row["type"], $row["district_id"]);
				$wards[] = $ward;
			}
		}

		return $wards; // This is array 
	}

	function getAll() {
		return $this->fetchAll();
	}

	function getByDistrictId($district_id) {
		global $conn; 
		$condition = "district_id = '$district_id'";
		return $this->fetchAll($condition, "name ASC");
	}

	function find($id) {
		$condition = "id = '$id'";
		$wards = $this->fetchAll($condition);
		$ward = current($wards);
		return $ward;
	}
}