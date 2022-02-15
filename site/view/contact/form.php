<?php require 'layout/header.php' ?>
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Liên hệ</span></li>
                </ol>
            </div>
        </div>
        <div class="row contact">
            <div class="col-md-6">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4981304733305!2d106.62440891371494!3d10.773108292323755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752dcdd60efd3f%3A0x8e16362a8a43158e!2zVGjhuqd5IEzhu5ljIGThuqF5IGzhuq1wIHRyw6xuaCB3ZWI!5e0!3m2!1svi!2s!4v1570486606187!5m2!1svi!2s"
                    width="100%" height="400px" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
            <div class="col-md-6">
                <h4>Thông tin liên hệ</h4>
                <form id="contact" class="form-contact" action="?" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="fullname" placeholder="Họ và tên" required
                            oninvalid="this.setCustomValidity('Vui lòng nhập tên của bạn')"
                            oninput="this.setCustomValidity('')" >
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input type="email" class="form-control" name="email" placeholder="Email" required
                                oninvalid="this.setCustomValidity('Vui lòng nhập email')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="tel" class="form-control" name="mobile" placeholder="Số điện thoại" required
                                pattern="[0][0-9]{9,}"
                                oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại bắt đầu bằng số 0 và ít nhất 9 con số theo sau')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <div class="form-group col-sm-12">

                            <textarea class="form-control" placeholder="Nội dung" name="content" rows="10"
                                required></textarea>
                        </div>

                        <div class="form-group col-sm-12">
                            <div class="message alert alert-success" style="display:none;"></div>
                        </div>

                        <div class="form-group col-sm-12">
                            <button type="submit" class="btn btn-sm btn-primary pull-right">Gửi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</main>
<?php require 'layout/footer.php' ?>