<?php
class NewsLetterRepository {
	protected $error;

	protected function fetchAll($condition = null)
	{
		global $conn;
		$newsletters = array();
		$sql = "SELECT * FROM newsletter";
		if ($condition) 
		{
			$sql .= " WHERE $condition";
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$newsletter = new NewsLetter($row["email"]);
				$newsletters[] = $newsletter;
			}
		}

		return $newsletters; // This is array 
	}

	function getAll() {
		return $this->fetchAll();
	}

	function save($data) {
		global $conn;
		$email = $data["email"];
		$sql = "INSERT INTO newsletter (email) VALUES ('$email')";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete($newLetter) {
		global $conn;
		$email = $newLetter->getEmail();
		$sql = "DELETE FROM newsletter WHERE email='$email'";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function find($email) {
		global $conn; 
		$condition = "email = '$email'";
		$newLetters = $this->fetchAll($condition);
		$newLetter = current($newLetters);
		return $newLetter;
	}

	function getError() {
		return $this->error;
	}
}