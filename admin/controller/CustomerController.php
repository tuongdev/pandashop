<?php
class CustomerController
{
	function list()
	{
		$page_title = "Khách hàng";
		$customerRepository = new CustomerRepository();
		$customers = $customerRepository->getAll();
		include "view/customer/list.php";
	}

	function add()
	{
		$page_title = "Thêm khách hàng";
		$provinceRepository = new ProvinceRepository();
		$provinces = $provinceRepository->getAll();
		include "view/customer/add.php";
	}

	function save()
	{
		$data = [];
		$data["name"] = $_POST["fullname"];
		$data["password"]  = md5($_POST["password"]);
		$data["mobile"] = $_POST["mobile"];
		$data["email"] = $_POST["email"];
		$data["login_by"] = "form";
		$data["shipping_name"] = $_POST["shipping_name"];
		$data["shipping_mobile"] = $_POST["shipping_mobile"];
		$data["ward_id"] = $_POST["ward"];
		$data["is_active"] = $_POST["active"];
		$data["housenumber_street"] = $_POST["housenumumber_street"];


		$customerRepository = new CustomerRepository();
		if ($customerRepository->save($data)) {
			header("location: index.php?c=customer");
			exit;
		}
	}

	function edit()
	{
		$page_title = "Cập nhật khách hàng";
		$id = $_GET["id"];
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->find($id);
		include "view/customer/edit.php";
	}

	function update()
	{
		$id = $_POST["id"];
		$name = $_POST["name"];
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->find($id);
		$customer->setName($name);
		if ($customerRepository->update($customer)) {
			header("location: index.php?c=customer");
			exit;
		}
	}

	function delete()
	{
		$id = $_GET["id"];
		if ($this->remove($id)) {
			header("location: index.php?c=customer");
		}
	}

	function remove($id)
	{
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->find($id);
		if ($customerRepository->delete($customer)) {
			return true;
		}
		echo $customerRepository->getError();
		return false;
	}

	function deletes()
	{
		$ids = $_POST["ids"];
		$flag = true;
		foreach ($ids as $id) {
			if (!$this->remove($id)) {
				$flag = false;
			}
		}

		if ($flag) {
			header("location: index.php?c=customer");
		}
	}
}
