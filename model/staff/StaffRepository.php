<?php
class StaffRepository extends BaseRepository{
	protected function fetchAll($condition = null)
	{
		global $conn;
		$staffs = array();
		$sql = "SELECT * FROM staff";
		if ($condition) 
		{
			$sql .= " WHERE $condition";
		}
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$staff = new Staff($row["id"], $row["name"], $row["mobile"], $row["username"], $row["password"], $row["email"], $row["role_id"], $row["is_active"]);
				$staffs[] = $staff;
			}
		}

		return $staffs;
	}

	function getAll() {
		return $this->fetchAll();
	}

	function findUsername($username) {
		global $conn; 
		$condition = "username = '$username'";
		$staffs = $this->fetchAll($condition);
		$staff = current($staffs);
		return $staff;
	}

	function findUsernameAndPassword($username, $password) {
		global $conn; 
		$condition = "username='$username' AND password='$password'";
		$staffs = $this->fetchAll($condition);
		$staff = current($staffs);
		return $staff;
	}

	function find($id) {
		global $conn; 
		$condition = "id = $id";
		$staffs = $this->fetchAll($condition);
		$staff = current($staffs);
		return $staff;
	}

	function save($data) {
		global $conn;
		$name = $data["name"];
		$password = $data["password"];
		$username = $data["username"];
		$mobile = $data["mobile"];
		$email = $data["email"];
		$role_id = $data["role_id"];
		$is_active = isset($data["is_active"]) ? $data["is_active"] : 1;

		$sql = "INSERT INTO staff (name, password, mobile, email, role_id, username, is_active) VALUES ('$name', '$password', '$mobile', '$email', $role_id, '$username', $is_active)";
		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;//chỉ cho auto increment
		    return $last_id;
		} 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function update($staff) {
		global $conn;
		$name = $staff->getName();
		$id = $staff->getId();
		$password = $staff->getPassword();
		$mobile = $staff->getMobile();
		$email = $staff->getEmail();
		$username = $staff->getUsername();
		$role_id = $staff->getRoleId();
		$is_active = $staff->getIsActive();

		$sql = "UPDATE staff 
			SET name='$name', password='$password', mobile='$mobile', email='$email', username='$username', role_id='$role_id', is_active=$is_active
			WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete($staff) {
		global $conn;
		$id = $staff->getId();
		$sql = "DELETE FROM staff WHERE id=$id";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}	

	function getByRoleId($role_id) {
		$condition = "role_id = $role_id";
		return $this->fetchAll($condition);
	}

	function getActionNames($staff) {
		global $conn;
		$actionNames = [];
		$role_id = $staff->getRoleId();
		$sql = "SELECT action.name 
			FROM role_action 
			JOIN action ON role_action.action_id = action.id
			WHERE role_action.role_id = $role_id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$actionNames[] = $row["name"];
			}
		}
		return $actionNames;
	}
}