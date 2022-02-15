<footer class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6 list ">
                        <div class="footerLink">
                            <h4>Danh mục</h4>
                            <?php
                            // Lấy tất cả các danh mục
                            $categoryRepository = new CategoryRepository();
                            $categories = $categoryRepository->getAll();
                            ?>
                            <ul class="list-unstyled">
                                <?php foreach ($categories as $cat) : ?>
                                    <li><a href="?c=product&category_id=<?= $cat->getId() ?>"><?= $cat->getName() ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 list">
                        <div class="footerLink">
                            <h4>Liên kết </h4>
                            <ul class="list-unstyled">
                                <li><a href="?c=product">Sản phẩm </a></li>
                                <li><a href="?c=information&a=returnPolicy">Chính sách đổi trả</a></li>
                                <li><a href="?c=information&a=paymentPolicy">Chính sách thanh toán</a></li>
                                <li><a href="?c=information&a=deliveriedPolicy">Chính sách giao hàng </a></li>
                                <li><a href="?c=contact&a=form">Liên hệ </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 list">
                        <div class="footerLink">
                            <h4>Liên hệ với chúng tôi </h4>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-phone-alt"></i> 0356.230.546</li>
                                <li><a href="mailto:tuongnguyen0896@gmail.com"><i class="fas fa-envelope"></i> Tuongdev96@gmail.com</a></li>
                            </ul>
                            <ul class="list-inline">
                                <li><a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="https://www.pinterest.com/"><i class="fab fa-pinterest"></i></a></li>
                                <li><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-10 list">
                        <div class="newsletter clearfix">
                            <h4>Bản tin</h4>
                            <p>Nhập Email của bạn để chúng tôi cung cấp thông tin nhanh nhất cho bạn về những sản phẩm mới!!</p>
                            <form class="newsletter-form" action="" method="POST">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Nhập email của bạn.." name="email">
                                    <div class="input-group-btn">

                                        <button type="submit" class="btn btn-primary send">Gửi</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</footer>
<!-- END FOOTER -->
<!-- BACK TO TOP -->
<div class="back-to-top hidden-xs hidden-sm" class="bg-color">▲</div>
<!-- END BACK TO TOP -->
<div class="zalo-vr hotline-phone-ring-wrap">
    <div class="hotline-phone-ring">
        <div class="hotline-phone-ring-circle"></div>
        <div class="hotline-phone-ring-circle-fill"></div>
        <div class="hotline-phone-ring-img-circle">
            <a href="https://zalo.me/0356230546" class="pps-btn-img">
                <img src="../upload/zalo.png" alt="Gọi điện thoại" width="50">
            </a>
        </div>
    </div>
    <div class="hotline-bar">
        <a href="https://zalo.me/0356230546">
            <span class="text-hotline">Chat với shop</span>
        </a>
    </div>
</div>

</div>

<div class="hotline-phone-ring-wrap">
    <div class="hotline-phone-ring">
        <div class="hotline-phone-ring-circle"></div>
        <div class="hotline-phone-ring-circle-fill"></div>
        <div class="hotline-phone-ring-img-circle">
            <a href="tel:0356230546" class="pps-btn-img">
                <img src="../upload/phone.png" alt="Gọi điện thoại" width="50">
            </a>
        </div>
    </div>
    <div class="hotline-bar">
        <a href="tel:0356230546">
            <span class="text-hotline">035.623.0546</span>
        </a>
    </div>

</div>
<!-- REGISTER DIALOG -->

<div class="modal fade " id="modal-register" role="lg">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-color">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title text-center">Đăng ký</h3>
            </div>
            <form class="form-register" action="?c=customer&a=register" method="POST" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="fullname" placeholder="Họ và tên" required oninvalid="this.setCustomValidity('Vui lòng nhập tên của bạn')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" name="mobile" placeholder="Số điện thoại" required pattern="[0][0-9]{9,}" oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại bắt đầu bằng số 0 và ít nhất 9 con số theo sau')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required oninvalid="this.setCustomValidity('Vui lòng nhập email')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" oninvalid="this.setCustomValidity('Vui lòng nhập ít nhất 8 ký tự: số, chữ hoa, chữ thường')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu" required autocomplete="off" autosave="off" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" oninvalid="this.setCustomValidity('Vui lòng nhập ít nhất 8 ký tự: số, chữ hoa, chữ thường')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group g-recaptcha" data-sitekey="<?= GOOGLE_RECAPTCHA_SITE ?>"></div>
                    <input type="text" name="hiddenRecaptcha" style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;">
                    <input type="hidden" name="reference" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- END REGISTER DIALOG -->
<!-- LOGIN DIALOG -->
<div class="modal fade" id="modal-login" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-color">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title text-center">Đăng nhập</h3>
                <!-- Google login -->
                <?php

                // init configuration
                $clientID = GOOGLE_CLIENT_ID;
                $clientSecret = GOOGLE_CLIENT_SECRET;
                $redirectUri =  get_domain() . $_SERVER['PHP_SELF'] . "?c=auth&a=loginGoogle";

                // create Client Request to access Google API
                $client = new Google_Client();
                $client->setClientId($clientID);
                $client->setClientSecret($clientSecret);
                $client->setRedirectUri($redirectUri);
                $client->addScope("email");
                $client->addScope("profile");
                $loginUrl = $client->createAuthUrl();

                ?>
                <br>
                <div class="text-center ">
                    <a class="btn btn-primary google-login" href="<?= $loginUrl ?>"><i class="fab fa-google"></i></i> Đăng nhập bằng Google</a>
                    <!-- Facebook login -->
                    <?php
                    $fb = new Facebook\Facebook([
                        'app_id' => FACEBOOK_CLIENT_ID, // Replace {app-id} with your app id
                        'app_secret' => FACEBOOK_CLIENT_SECRET,
                        'default_graph_version' => 'v3.2',
                    ]);

                    $helper = $fb->getRedirectLoginHelper();

                    $permissions = ['email']; // Optional permissions
                    $callback = get_domain() . $_SERVER['PHP_SELF'] . "?c=auth&a=loginFacebook";
                    $loginUrl = $helper->getLoginUrl($callback, $permissions);
                    // echo $loginUrl; 
                    ?>
                    <a class="btn btn-primary facebook-login" href="<?= $loginUrl ?>"><i class="fab fa-facebook-f"></i> Đăng nhập bằng Facebook</a>
                </div>
            </div>

            <form action="?c=login&a=login" method="POST" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                    </div>
                    <input type="hidden" name="reference" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Đăng Nhập</button><br>
                    <div class="text-left">
                        <a href="javascript:void(0)" class="btn-register">Bạn chưa là thành viên? Đăng kí ngay!</a>
                        <a href="javascript:void(0)" class="btn-forgot-password">Quên Mật Khẩu?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END LOGIN DIALOG -->
<!-- FORTGOT PASSWORD DIALOG -->
<div class="modal fade" id="modal-forgot-password" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-color">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title text-center">Quên mật khẩu</h3>
            </div>
            <form action="?c=customer&a=forgotPassword" method="POST" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <input name="email" type="email" class="form-control" placeholder="Email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="reference" value="">
                    <button type="submit" class="btn btn-primary">GỬI</button><br>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END FORTGOT PASSWORD DIALOG -->
<!-- CART DIALOG -->
<div class="modal fade" id="modal-cart-detail" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-color">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title text-center">Giỏ hàng</h3>
            </div>
            <div class="modal-body">
                <div class="page-content">
                    <div class="clearfix hidden-xs">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-3">
                            <div class="header">
                                Sản phẩm
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="header">
                                Đơn giá
                            </div>
                        </div>
                        <div class="label_item col-xs-3">
                            <div class="header">
                                Số lượng
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="header">
                                Thành tiền
                            </div>
                        </div>
                        <div class="lcol-xs-1">
                        </div>
                    </div>
                    <div class="cart-product">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="clearfix">
                    <div class="col-xs-12 text-right">
                        <p>
                            <span>Tổng tiền</span>
                            <span class="price-total">0₫</span>
                        </p>
                        <input type="button" name="back-shopping" class="btn btn-default" value="Tiếp tục mua sắm">
                        <input type="button" name="checkout" class="btn btn-primary" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CART DIALOG -->
<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "103675848823553");
  chatbox.setAttribute("attribution", "biz_inbox");

  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v12.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

</body>

</html>