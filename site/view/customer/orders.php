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
            <div class="col-md-9 order">
                <div class="row">
                    <div class="col-xs-6">
                        <h4 class="home-title">Đơn hàng của tôi</h4>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <!-- Mỗi đơn hàng -->
                        <div class="row">
                            <?php foreach ($orders as $order) : ?>
                                <div class="col-md-12">
                                    <h5>Đơn hàng <a href="?c=customer&a=orderDetail&id=<?=$order->getId()?>">#<?=$order->getId()?></a></h5>
                                    <span class="date">
                                        Đặt hàng ngày <?=$order->getCreatedDate()?> </span>
                                    <hr>
                                    <?php foreach ($order->getOrderItems() as $orderItem) :
                                         $product = $orderItem->getProduct();
                                        ?>
                                        <div class="row">
                                    <div class="col-md-2">
                                        <img src="../upload/<?=$product->getFeaturedImage()?>" alt="" class="img-responsive">
                                    </div>
                                    <div class="col-md-3">
                                        <a class="product-name" href="chi-tiet-san-pham.html"><?=$product->getName()?></a>
                                    </div>
                                    <div class="col-md-2">
                                        Số lượng: <?=$orderItem->getQty()?>
                                    </div>
                                    <div class="col-md-2">
                                        <?=$order->getStatus()->getDescription()?>
                                    </div>
                                    <div class="col-md-3">
                                        Dự kiến giao hàng
                                         <?=$order->getDeliveredDate()?>
                                    </div>
                                </div>
                                    <?php endforeach ?>
                                </div>
                            <?php endforeach ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require 'layout/footer.php' ?>