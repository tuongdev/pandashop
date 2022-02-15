<?php require 'layout/header.php' ?>
<main id="maincontent" class="page-main">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="/" target="_self">Giỏ hàng</a></li>
                            <li><span>/</span></li>
                            <li class="active"><span>Thông tin giao hàng</span></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <aside class="col-md-6 cart-checkout">
                     <?php foreach ($cart->getItems() as $item): ?>
                        <div class="row">
                            <div class="col-xs-2">
                                <img class="img-responsive" src="../upload/<?=$item['img']?>" alt="<?=$item['name']?>"> 
                            </div>
                            <div class="col-xs-7">
                                <a class="product-name" href="?c=product&a=show&id=<?=$item['product_id']?>"><?=$item['name']?></a> 
                                <br>
                                <span><?=$item['qty']?></span> x <span><?=number_format($item['unit_price'])?></span>
                            </div>
                            <div class="col-xs-3 text-right">
                                <span><?=number_format($item['total_price'])?></span>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach ?>
                        <div class="row">
                            <div class="col-xs-6">
                                Tạm tính
                            </div>
                            <div class="col-xs-6 text-right">
                            <?=number_format($cart->getTotalPrice())?>đ
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                Phí vận chuyển
                            </div>
                            <div class="col-xs-6 text-right">
                                <span class="shipping-fee" data=""><?=number_format($shipping_fee)?>đ</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6">
                                Tổng cộng
                            </div>
                            <div class="col-xs-6 text-right">
                                <span class="payment-total" data="<?=$cart->getTotalPrice()?>"><?=number_format($shipping_fee + $cart->getTotalPrice())?>₫</span>
                            </div>
                        </div>
                    </aside>
                    <div class="ship-checkout col-md-6">
                        <h4>Thông tin giao hàng</h4>
                        <div>Bạn đã có tài khoản? <a href="javascript:void(0)" class="btn-login">Đăng Nhập  </a></div>
                        <br>
                        <form action="?c=payment&a=order" method="POST">
                            <?php require 'layout/address.php' ?>
                            <h4>Phương thức thanh toán</h4>
                            <div class="form-group">
                                <label> <input type="radio" name="payment_method" checked="" value="0"> Thanh toán khi giao hàng (COD) </label>
                                <div></div>
                            </div>
                            <div class="form-group">
                                <label> <input type="radio" name="payment_method" value="1"> Chuyển khoản qua ngân hàng </label>
                                <div class="bank-info">STK: 0421003707901<br>Chủ TK: Nguyễn Hữu Lộc. Ngân hàng: Vietcombank TP.HCM <br>
                                    Ghi chú chuyển khoản là tên và chụp hình gửi lại cho shop dễ kiểm tra ạ
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-sm btn-primary pull-right">Hoàn tất đơn hàng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php require 'layout/footer.php' ?>