<?php 
class PaymentController {
    function checkout() {
        $cartStorage = new CartStorage();
        $cart = $cartStorage->fetch();
        if (empty($cart->getTotalProductNumber())) {
            header("location: index.php?c=product");
            exit;
        }
        $email = "khachvanglai@gmail.com";
        if (!empty($_SESSION["email"])) {
            $email = $_SESSION["email"];
        }
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);

        include "layout/variable_address.php";
        include "view/payment/checkout.php";
    }
    function order() {
        $email = "khachvanglai@gmail.com";
        if (!empty($_SESSION["email"])) {
            $email = $_SESSION["email"];
        }
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);

        $provinceRepository = new ProvinceRepository();
        $province = $provinceRepository->find($_POST["province"]);
        $data = [];
        $data["created_date"] = date("Y-m-d H:i:s"); 
        $data["order_status_id"] = 1;
        $data["staff_id"] = null;
        $data["customer_id"] = $customer->getId();
        $data["shipping_fullname"] = $_POST["fullname"];
        $data["shipping_mobile"] = $_POST["mobile"];
        $data["payment_method"] = $_POST["payment_method"];
        $data["shipping_ward_id"] = $_POST["ward"];
        $data["shipping_housenumber_street"] = $_POST["address"];
        $data["shipping_fee"] = $province->getShippingFee();
        $data["delivered_date"] = date("Y-m-d", strtotime("+3 days"));
        
        $orderRepository = new OrderRepository();
        $orderItemRepository = new OrderItemRepository();
        $order_id = $orderRepository->save($data);
        if (!empty($order_id)) {
            $cartStorage = new CartStorage();
            $cart = $cartStorage->fetch();
            $items = $cart->getItems();
            foreach ($items as $item) {
                $itemData = [];
                $itemData["product_id"] = $item["product_id"]; 
                $itemData["order_id"] = $order_id; 
                $itemData["qty"] =  $item["qty"];
                $itemData["unit_price"] = $item["unit_price"];
                $itemData["total_price"] = $item["total_price"];
                $orderItemRepository->save($itemData);
            }
        }
        $cartStorage->clear();
        $_SESSION["success"] = "Đơn hàng của bạn đã được tạo";
        header("location: index.php?c=product");

    }
}
?>