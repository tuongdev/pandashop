<?php require 'layout/header.php' ?>
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Tài khoản</span></li>
                </ol>
            </div>
            <div class="clearfix"></div>
            <?php require 'view/customer/sidebar.php' ?>
            <div class="col-md-9 order-info">
                <div class="row">
                    <div class="col-xs-6">
                        <h4 class="home-title">Đơn hàng #<?= $order->getId() ?></h4>
                    </div>
                    <div class="clearfix"></div>
                    <aside class="col-md-7 cart-checkout">
                        <?php foreach ($order->getOrderItems() as $orderItem) :
                            $product = $orderItem->getProduct();
                        ?>
                            <div class="row">
                                <div class="col-xs-2">
                                    <img class="img-responsive" src="../upload/<?= $product->getFeaturedImage() ?>" alt="<?= $product->getName() ?>">
                                </div>
                                <div class="col-xs-7">
                                    <a class="product-name" href="?c=customer&a=show"><?= $product->getName() ?></a>
                                    <br>
                                    <span><?= $orderItem->getQty() ?></span> x <span><?= number_format($orderItem->getUnitPrice()) ?>đ</span>
                                </div>
                                <div class="col-xs-3 text-right">
                                    <span><?= number_format($orderItem->getTotalPrice()) ?>đ</span>
                                </div>
                            </div>
                            <hr>
                            <hr>
                        <?php endforeach ?>
                        <div class="row">
                            <div class="col-xs-6">
                                Tạm tính
                            </div>
                            <div class="col-xs-6 text-right">
                                <?= number_format($order->getSubTotalPrice()) ?>đ
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                Phí vận chuyển
                            </div>
                            <div class="col-xs-6 text-right">
                                <?= number_format($order->getShippingFee()) ?>đ
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6">
                                Tổng cộng
                            </div>
                            <div class="col-xs-6 text-right">
                                <?= number_format($order->getSubTotalPrice() + $order->getShippingFee()) ?>đ
                            </div>
                        </div>
                    </aside>
                    <div class="ship-checkout col-md-5">
                        <h4>Thông tin giao hàng</h4>
                        <div>
                            Họ và tên: <?= $order->getShippingFullname() ?>
                        </div>
                        <div>
                            Số điện thoại: <?= $order->getShippingMobile() ?>
                        </div>
                        <div>
                            <?php 
                            $ward = $order->getShippingWard();
                            $district = $ward->getDistrict();
                            $province = $district->getProvince();
                            ?>
                            <?=$province->getName()?>
                        </div>
                        <div>
                        <?=$district->getName()?>
                        </div>
                        <div>
                        <?=$ward->getName()?>
                        </div>
                        <div>
                            <?=$order->getShippingHousenumberStreet()?>
                        </div>
                        <div>
                            Phương thức thanh toán: <?=$order->getPaymentMethod() == 0 ? 'Bank' : 'COD'?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require 'layout/footer.php' ?>