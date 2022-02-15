<?php 
class Order {
	protected $id;
	protected $created_date;
	protected $order_status_id;
	protected $staff_id;
	protected $customer_id;
	protected $shipping_fullname;
	protected $shipping_mobile;
	protected $payment_method;
	protected $shipping_ward_id;
	protected $shipping_housenumber_street;
	protected $shipping_fee;
	protected $delivered_date;

	function __construct($id, $created_date, $order_status_id, $staff_id, $customer_id, $shipping_fullname, $shipping_mobile, $payment_method, $shipping_ward_id, $shipping_housenumber_street, $shipping_fee, $delivered_date){
		$this->id = $id;
		$this->created_date = $created_date;
		$this->order_status_id = $order_status_id;
		$this->staff_id = $staff_id;
		$this->customer_id = $customer_id;
		$this->shipping_fullname = $shipping_fullname;
		$this->shipping_mobile = $shipping_mobile;
		$this->payment_method = $payment_method;
		$this->shipping_ward_id = $shipping_ward_id;
		$this->shipping_housenumber_street = $shipping_housenumber_street;
		$this->shipping_fee = $shipping_fee;
		$this->delivered_date = $delivered_date;
	}

	function getId() {
		return $this->id;
	}

	function getCreatedDate() {
		return $this->created_date;
	}

	function getStatusId() {
		return $this->order_status_id;
	}

	function getStaffId() {
		return $this->staff_id;
	}

	function getCustomerId() {
		return $this->customer_id;
	}

	function getShippingFullname() {
		return $this->shipping_fullname;
	}

	function getShippingMobile() {
		return $this->shipping_mobile;
	}

	function getPaymentMethod() {
		return $this->payment_method;
	}

	function getShippingWardId() {
		return $this->shipping_ward_id;
	}

	function getShippingHousenumberStreet() {
		return $this->shipping_housenumber_street;
	}

	function getShippingFee() {
		return $this->shipping_fee;
	}

	function getDeliveredDate() {
		return $this->delivered_date;
	}

	function setCreatedDate($created_date) {
		$this->created_date = $created_date;
		return $this;
	}

	function setStatusId($order_status_id) {
		$this->order_status_id = $order_status_id;
		return $this;
	}

	function setStaffId($staff_id) {
		$this->staff_id = $staff_id;
		return $this;
	}

	function setCustomerId($customer_id) {
		$this->customer_id = $customer_id;
		return $this;
	}

	function setShippingFullname($shipping_fullname) {
		$this->shipping_fullname = $shipping_fullname;
		return $this;
	}

	function setShippingMobile($shipping_mobile) {
		$this->shipping_mobile = $shipping_mobile;
		return $this;
	}

	function setPaymentMethod($payment_method) {
		$this->payment_method = $payment_method;
		return $this;
	}

	function setShippingWardId($shipping_ward_id) {
		$this->shipping_ward_id = $shipping_ward_id;
		return $this;
	}

	function setShippingHousenumberStreet($shipping_housenumber_street) {
		$this->shipping_housenumber_street = $shipping_housenumber_street;
		return $this;
	}

	function setShippingFee($shipping_fee) {
		$this->shipping_fee = $shipping_fee;
		return $this;
	}

	function setDeliveredDate($delivered_date) {
		$this->delivered_date = $delivered_date;
		return $this;
	}


	function getStatus() {
		$statusRepository = new StatusRepository();
		$status = $statusRepository->find($this->order_status_id);
		return $status;
	}

	function getStaff() {
		if (empty($this->staff_id)) return null;
		$staffRepository = new StaffRepository();
		$staff = $staffRepository->find($this->staff_id);
		return $staff;
	}

	function getCustomer() {
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->find($this->customer_id);
		return $customer;
	}

	function getShippingWard() {
		$wardRepository = new WardRepository();
		$ward = $wardRepository->find($this->shipping_ward_id);
		return $ward;
	}

	function getOrderItems() {
		$orderItemRepository = new OrderItemRepository();
		$orderItems = $orderItemRepository->getByOrderId($this->id); 
		return $orderItems;
	}

	function getSubTotalPrice() {
		$totalPrice = 0;
		$orderItems = $this->getOrderItems();
        foreach($orderItems as $orderItem) {
            $totalPrice += $orderItem->getTotalPrice();
        }
        return $totalPrice;
	}
}
