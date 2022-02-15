<?php
class CustomerRepository extends BaseRepository{
	protected function fetchAll($condition = null)
	{
		
		global $conn;
		$customers = array();
		$sql = "SELECT * FROM customer";
			
		if ($condition) 
		{
			$sql .= " WHERE $condition";
		}

		$result = $conn->query($sql);
		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				
				$customer = new Customer($row["id"], $row["name"], $row["password"], $row["mobile"], $row["email"], $row["login_by"], $row["shipping_name"], $row["shipping_mobile"], $row["ward_id"], $row["housenumber_street"], $row["is_active"]);
				$customers[] = $customer;
			}
		}

		return $customers;
	}

	function getAll() {
		return $this->fetchAll();
	}

	function findEmail($email) {
		global $conn; 
		$condition = "email = '$email'";
		$customers = $this->fetchAll($condition);
		$customer = current($customers);
		return $customer;
	}

	function findEmailAndPassword($email, $password) {
		global $conn; 
		$condition = "email = '$email' AND password = '$password'";
		$customers = $this->fetchAll($condition);
		$customer = current($customers);
		return $customer;
	}


	function save($data) {
		global $conn;
		$name = $data["name"];
		$password = $data["password"];
		$mobile = $data["mobile"];
		$email = $data["email"];
		$login_by = $data["login_by"];
		$shipping_name = $data["shipping_name"];
		$shipping_mobile = $data["shipping_mobile"];
		$ward_id = $data["ward_id"];
		$is_active = $data["is_active"];
		$housenumber_street = $data["housenumber_street"];
		if (empty($ward_id)) {
			$ward_id = "NULL";
		}

		if (empty($is_active)) {
			$is_active = 0;
		}

		$sql = "INSERT INTO customer (name, password, mobile, email, login_by, shipping_name, shipping_mobile, ward_id, housenumber_street, is_active) VALUES ('$name', '$password', '$mobile', '$email', '$login_by','$shipping_name', '$shipping_mobile' ,$ward_id, '$housenumber_street', $is_active)";
		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;//chỉ cho auto increment
		    return $last_id;
		} 
		$this->error =  "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function update($customer) {
		global $conn;
		$name = $customer->getName();
		$id = $customer->getId();
		$password = $customer->getPassword();
		$mobile = $customer->getMobile();
		$email = $customer->getEmail();
		$login_by = $customer->getLoginBy();
		$shipping_name = $customer->getShippingName();
		$shipping_mobile = $customer->getShippingMobile();
		$ward_id = $customer->getWardId();
		$housenumber_street = $customer->getHouseNumberStreet();
		$is_active = $customer->getIsActive();
		if (empty($ward_id)) {
			$ward_id = "NULL";
		}
		else {
			$ward_id = "'$ward_id'";
		}

		if (empty($is_active)) {
			$is_active = 0;
		}
		$sql = "UPDATE customer 
			SET name='$name',password='$password',mobile='$mobile',email='$email',login_by='$login_by',shipping_name='$shipping_name', shipping_mobile='$shipping_mobile', ward_id = $ward_id, housenumber_street = '$housenumber_street', is_active = $is_active
			WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete($customer) {
		global $conn;
		$id = $customer->getId();
		$sql = "DELETE FROM customer WHERE id=$id";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function find($id) {
		global $conn; 
		$condition = "id = $id";
		$customers = $this->fetchAll($condition);
		$customer = current($customers);
		return $customer;
	}
}