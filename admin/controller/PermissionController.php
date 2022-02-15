<?php 
class PermissionController {
	function test(){
		$actionRepository = new ActionRepository();
		$actions = $actionRepository->getAll();
		foreach ($actions as $action) {
			// const VIEW_PRODUCT = "view_product";
			$actionName = $action->getName();
			$uActionName = strtoupper($actionName);
			echo "const $uActionName = \"$actionName\";<br>";
		}
	}

	function listRole(){
		$roleRepository = new RoleRepository();
		$roles = $roleRepository->getAll();
		include "view/permission/listRole.php";
	}

	function editRole() {
		$id = $_GET["id"];
		$roleRepository = new RoleRepository();
		$role = $roleRepository->find($id);
		include "view/permission/editRole.php";
	}

	function updateRole() {
		$name = $_POST["fullname"];
		$role_id = $_POST["role_id"];
		$roleRepository = new RoleRepository();
		//kiểm tra có bị trùng name không
		$currentRole = $roleRepository->getByName($name);
		if ($currentRole && $currentRole->getId() != $role_id) {
			$_SESSION["error"] = "Lỗi: Vai trò $name đã tồn tại";
			header("location: index.php?c=permission&a=listRole");
			exit;
		}

		$role = $roleRepository->find($role_id);
		$role->setName($name);
		if ($roleRepository->update($role)) {
			$_SESSION["message"] = "Cập nhật thành công";
			header("location: index.php?c=permission&a=listRole");
			exit;
		}
		echo $roleRepository->getError();
	}

	function addRole() {
		include "view/permission/addRole.php";
	}

	function saveRole() {
		$name = $_POST["fullname"];
		$data = [];
		$data["name"] = $name;
		$roleRepository = new RoleRepository();
		//check existing role similar name
		if ($roleRepository->getByName($name)) {
			$_SESSION["error"] = "Lỗi: Vai trò $name đã tồn tại";
			header("location: index.php?c=permission&a=listRole");
			exit;
		}

		if ($roleRepository->save($data)) {
			$_SESSION["message"] = "Tạo vai trò thành công";
			header("location: index.php?c=permission&a=listRole");
			exit;
		}
		echo $roleRepository->getError();
	}

	function checkDeleteRole(){
		//remove later
		$role_id = $_GET["role_id"];
		$roleRepository = new RoleRepository();
		$role = $roleRepository->find($role_id);
		$roleActions = $role->getActions();
		if (count($roleActions) > 0) {
			//không xóa được
			echo json_encode(["can_delete" => 0, "message" => "Vai trò {$role->getName()} có tác vụ, không thể xóa"]);
			return;
		}

		$staffs = $role->getStaffs();
		if (count($staffs) > 0) {
			//không xóa được
			echo json_encode(["can_delete" => 0, "message" => "Vai trò {$role->getName()} có nhân viên đang sử dụng, không thể xóa"]);
			return;
		}
		//xóa được
		echo json_encode(["can_delete" => 1, "message" => "OK"]);
		return;

	}

	function deleteRole() {
		$id = $_GET["id"];
		if ($this->removeRole($id)) {
			header("location: index.php?c=permission&a=listRole");
		}
	}

	function removeRole($id) {
		$roleRepository = new RoleRepository();
		$role = $roleRepository->find($id);
		if($roleRepository->delete($role)) {
			$_SESSION["message"] = "Vai trò {$role->getName()} đã xóa thành công";
			return true;
		}
		echo $roleRepository->getError();
		return false;

	}

	function listAction(){
		$actionRepository = new ActionRepository();
		$actions = $actionRepository->getAll();
		include "view/permission/listAction.php";
	}

	function listRoleAction() {
		$actionRepository = new ActionRepository();
		$actions = $actionRepository->getAll();

		$role_id = $_GET["id"];
		$roleRepository = new RoleRepository();
		$role = $roleRepository->find($role_id);
		$roleActions = $role->getActions();

		$selected_actions = [];
		foreach ($roleActions as $roleAction):
			$selected_actions[] = $roleAction->getActionId();
		endforeach;

		include "view/permission/listRoleAction.php";
	}

	function updateRoleAction() {
		$role_id = $_POST["role_id"];
		$action_ids = $_POST["action_ids"];

		$roleRepository = new RoleRepository();
		$role = $roleRepository->find($role_id);

		$roleActionRepository = new RoleActionRepository();
		$roleActionRepository->deleteByRoleId($role_id);
		foreach ($action_ids as $action_id) {
			$data = [];
			$data["action_id"] = $action_id;
			$data["role_id"] = $role_id;
			$roleActionRepository->save($data);
		}

		$_SESSION["message"] = "Cập nhật vài trò {$role->getName()} thành công";
		header("location: index.php?c=permission&a=listRoleAction&id=$role_id");
		exit;
	}

}