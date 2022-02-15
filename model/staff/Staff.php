<?php 
class Staff
{
	protected $id;
	protected $name;
	protected $mobile;
	protected $username;
	protected $password;
	protected $email;
	protected $role_id;
	protected $is_active;
	
	function __construct($id, $name, $mobile, $username, $password, $email, $role_id, $is_active){
		$this->id = $id;
		$this->name = $name;
		$this->mobile = $mobile;
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
		$this->role_id = $role_id;
		$this->is_active = $is_active;
	}

	function getId(){
		return $this->id;
	}

	function getName(){
		return $this->name;
	}

	function getUsername() {
		return $this->username;
	}

	function getPassword() {
		return $this->password;
	}

	function getMobile() {
		return $this->mobile;
	}

	function getEmail() {
		return $this->email;
	}

	function getRoleId() {
		return $this->role_id;
	}

	function getIsActive() {
		return $this->is_active;
	}

	function setName($name){
		$this->name = $name;
		return $this;
	}

	function setUsername($username) {
		$this->username = $username;
		return $this;
	}

	function setPassword($password) {
		$this->password = $password;
		return $this;
	}

	function setMobile($mobile) {
		$this->mobile = $mobile;
		return $this;
	}

	function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	function setRoleId($role_id) {
		$this->role_id = $role_id;
		return $this;
	}

	function setIsActive($is_active) {
		$this->is_active = $is_active;
		return $this;
	}

	function getRole() {
		$roleRepository = new RoleRepository();
		$role = $roleRepository->find($this->role_id);
		return $role;
	}
}