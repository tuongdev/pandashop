<?php 
class StaffController {
	function list() {
		$page_title = "Nhân viên";
		$staffRepository = new StaffRepository();
		$staffs = $staffRepository->getAll();
		include "view/staff/list.php";
	}

	function add() {
		$page_title = "Thêm nhân viên";
		$roleRepository = new RoleRepository();
		$roles = $roleRepository->getAll();
		include "view/staff/add.php";
	}

	function save() {
		$data = []; 
		$data["name"] = $_POST["fullname"];
		$data["password"] = md5($_POST["password"]);
		$data["username"] = $_POST["username"];
		$data["mobile"] = $_POST["mobile"];
		$data["email"] = $_POST["email"];
		$data["role_id"] = $_POST["role_id"];
		$data["is_active"] = 0;
		if (!empty($_POST["is_active"])) {
			$data["is_active"] = 1;
		}

		$staffRepository = new StaffRepository();
		if ($staffRepository->save($data)) {
			header("location: index.php?c=staff");
			exit;
		}
	}

	function edit() {
		$page_title = "Cập nhật khách hàng";
		$id = $_GET["id"];
		$staffRepository = new StaffRepository();
		$staff = $staffRepository->find($id);

		$roleRepository = new RoleRepository();
		$roles = $roleRepository->getAll();

		include "view/staff/edit.php";
	}

	function update() {

		$id = $_POST["id"];
		$name = $_POST["fullname"];
		$staffRepository = new StaffRepository();
		$staff = $staffRepository->find($id);
		$staff->setName($name);
		$staff->setUsername($_POST["username"]);
		if (!empty($_POST["password"])) {
			$staff->setPassword(md5($_POST["password"]));
		}
		$staff->setEmail($_POST["email"]);
		$staff->setMobile($_POST["mobile"]);
		$staff->setRoleId($_POST["role_id"]);

		$staff->setIsActive(0);
		if (!empty($_POST["is_active"])) {
			$staff->setIsActive(1);
		}
		
		
		if ($staffRepository->update($staff)) {
			header("location: index.php?c=staff");
			exit;
		}

	}

	function active() {
		$id = $_GET["id"];
		if ($this->activeOrDisable($id, 1)) {
			header("location: index.php?c=staff");
			exit;
		}
	}

	function disable() {
		$id = $_GET["id"];
		if ($this->activeOrDisable($id, 0)) {
			header("location: index.php?c=staff");
			exit;
		}
		
	}

	protected function activeOrDisable($id, $is_active) {
		
		$staffRepository = new StaffRepository();
		$staff = $staffRepository->find($id);
		if ($staff->getRoleId() == 1) {//quản trị viên
			return true;
		}
		$staff->setIsActive($is_active);
		return $staffRepository->update($staff);
	}


	function activeOrDisableMulti() {
		$ids = $_POST["ids"];
		$flag = true;
		$is_active = !empty($_POST["activeMulti"]) ? 1: 0;

		foreach ($ids as $id) {
			if (!$this->activeOrDisable($id, $is_active)) {
				$flag = false;
			}
		}

		if ($flag) {
			header("location: index.php?c=staff");
		}
	}
}