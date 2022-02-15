<?php
class CommentRepository extends BaseRepository{
	
	protected function fetchAll($condition = null, $sort = null)
	{
		global $conn;
		$comments = array();
		$sql = "SELECT * FROM comment";
		if ($condition) 
		{
			$sql .= " WHERE $condition";
		}

		if ($sort) {
			$sql .= " $sort";
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				
				$comment = new Comment($row["id"], $row["email"], $row["fullname"], $row["star"], $row["created_date"], $row["description"], $row["product_id"]);
				$comments[] = $comment;
			}
		}

		return $comments;
	}

	function getAll() {
		return $this->fetchAll();
	}

	function find($id) {
		global $conn; 
		$condition = " id = $id";
		$comments = $this->fetchAll($condition);
		$comment = current($comments);
		return $comment;
	}

	function save($data) {
		global $conn;
		$email = $data["email"];
		$fullname = $data["fullname"];
		$star = $data["star"];
		$created_date = $data["created_date"];
		$description = $data["description"];
		$product_id = $data["product_id"];

		$sql = "INSERT INTO comment (email,
		fullname, star, created_date,
		description, product_id) VALUES ('$email', '$fullname', '$star', '$created_date', '$description', $product_id)";
		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;//chỉ cho auto increment
		    return $last_id;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function update($comment) {
		global $conn;
		
		$id = $comment->getId();
		$email = $comment->getEmail();
		$fullname = $comment->getFullname();
		$star = $comment->getStar();
		$created_date = $comment->getCreatedDate();
		$description = $comment->getDescription();
		$product_id = $comment->getProductId();
		$sql = "UPDATE comment SET 
			email='$email',
			fullname='$fullname',
			star='$star',		
			created_date='$created_date',
			description='$description',
			product_id=$product_id
			WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete($comment) {
		global $conn;
		$id = $comment->getId();
		$sql = "DELETE FROM comment WHERE id=$id";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function getByProductId($product_id) {
		return $this->fetchAll("product_id = $product_id", "ORDER BY id DESC");
	}
}