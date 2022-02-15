<?php 
class RoleAction
{
	protected $role_id;
	protected $action_id;

	function __construct($role_id, $action_id){
		$this->role_id = $role_id;
		$this->action_id = $action_id;
	}

	function getRoleId(){
		return $this->role_id;
	}

	function getActionId(){
		return $this->action_id;
	}

	function getAction() {
		$actionRepository = new ActionRepository();
		$action = $actionRepository->find($this->action_id);
		return $action;
	}
}