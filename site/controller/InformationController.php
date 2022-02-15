<?php 
class InformationController {
    function returnPolicy() {
        require 'view/information/returnPolicy.php';
    }

    function paymentPolicy() {
        require 'view/information/paymentPolicy.php';
    }

    function deliveriedPolicy() {
        require 'view/information/deliveriedPolicy.php';
    }
}
?>