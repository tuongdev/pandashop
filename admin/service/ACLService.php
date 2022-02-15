<?php 
class ACLService {
	protected $message;

	const VIEW_PRODUCT = "view_product";
	const ADD_PRODUCT = "add_product";
	const EDIT_PRODUCT = "edit_product";
	const DELETE_PRODUCT = "delete_product";
	const VIEW_STAFF = "view_staff";
	const ADD_STAFF = "add_staff";
	const EDIT_STAFF = "edit_staff";
	const DELETE_STAFF = "delete_staff";
	const VIEW_ORDER = "view_order";
	const ADD_ORDER = "add_order";
	const EDIT_ORDER = "edit_order";
	const DELETE_ORDER = "delete_order";
	const VIEW_CUSTOMER = "view_customer";
	const ADD_CUSTOMER = "add_customer";
	const EDIT_CUSTOMER = "edit_customer";
	const DELETE_CUSTOMER = "delete_customer";
	const VIEW_CATEGORY = "view_category";
	const ADD_CATEGORY = "add_category";
	const EDIT_CATEGORY = "edit_category";
	const DELETE_CATEGORY = "delete_category";
	const VIEW_TRANSPORT = "view_transport";
	const ADD_TRANSPORT = "add_transport";
	const EDIT_TRANSPORT = "edit_transport";
	const DELETE_TRANSPORT = "delete_transport";
	const VIEW_BRAND = "view_brand";
	const ADD_BRAND = "add_brand";
	const EDIT_BRAND = "edit_brand";
	const DELETE_BRAND = "delete_brand";
	const VIEW_STATUS = "view_status";
	const ADD_STATUS = "add_status";
	const EDIT_STATUS = "edit_status";
	const DELETE_STATUS = "delete_status";
	const VIEW_NEWSLETTER = "view_newsletter";
	const ADD_NEWSLETTER = "add_newsletter";
	const EDIT_NEWSLETTER = "edit_newsletter";
	const DELETE_NEWSLETTER = "delete_newsletter";//done
	const VIEW_PERMISSION = "view_permission";
	const ADD_PERMISSION = "add_permission";
	const EDIT_PERMISSION = "edit_permission";
	const DELETE_PERMISSION = "delete_permission";
	const VIEW_COMMENT = "view_comment";
	const ADD_COMMENT = "add_comment";
	const EDIT_COMMENT = "edit_comment";
	const DELETE_COMMENT = "delete_comment";

	
	function hasPermission(Staff $staff, $c, $a) {
		$paramToAclActionService = new ParamToAclActionService();
		$execActionName = $paramToAclActionService->getActionName($c, $a);
		if (empty($execActionName)) {
			return true;
		}
		$actionNames = $this->getActionNames($staff);

		if (!in_array($execActionName, $actionNames)) {
			$actionRepository = new ActionRepository();
			$action = $actionRepository->findByName($execActionName);
			$actionDescription = lcfirst($action->getDescription());
			$this->message = "Error: Bạn không có quyền $actionDescription";
			return false;
		}
		return true;
		
	}

	// Trả về danh sách tên action của nhân viên
	function getActionNames(Staff $staff) {
		$staffRepository = new StaffRepository();
		$actionNames = $staffRepository->getActionNames($staff);
		return $actionNames;
	}

	function getMessage() {
		return $this->message;
	}
}

?>
