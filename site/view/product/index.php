<?php require 'layout/header.php' ?>
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Tất cả sản phẩm</span></li>
                </ol>
            </div>
            <div class="col-xs-3 hidden-lg hidden-md">
                <a class="hidden-lg pull-right btn-aside-mobile" href="javascript:void(0)">Bộ lọc <i class="fa fa-angle-double-right"></i></a>
            </div>
            <div class="clearfix"></div>
            <?php require 'layout/sidebar.php' ?>
            <div class="col-md-9 products">
                <div class="row equal">
                    <div class="col-xs-6">
                        <h4 class="home-title">Tất cả sản phẩm</h4>
                    </div>
                    <div class="col-xs-6 sort-by">
                        <div class="pull-right">
                            <label class="left hidden-xs" for="sort-select">Sắp xếp: </label>
                            <select id="sort-select">
                                <option value="" selected>Mặc định</option>
                                <option value="price-asc">Giá tăng dần</option>
                                <option value="price-desc">Giá giảm dần</option>
                                <option value="alpha-asc">Từ A-Z</option>
                                <option value="alpha-desc">Từ Z-A</option>
                                <option value="created-asc">Cũ đến mới</option>
                                <option value="created-desc">Mới đến cũ</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php foreach ($products as $product) : ?>
                        <div class="col-xs-6 col-sm-4">
                            <?php require 'layout/product.php' ?>
                        </div>
                    <?php endforeach ?>
                </div>
                <!-- Paging -->
                <ul class="pagination pull-right">
                    <?php if ($page > 1) : ?>
                        <li><a href="javascript:void(0)" onclick="goToPage(<?= $page - 1 ?>)">Trước</a></li>
                    <?php endif ?>
                    <?php for ($i = 1; $i <= $page_number; $i++) : ?>
                        <li class="<?=$i == $page ? 'active' : ''?>"><a href="javascript:void(0)" onclick="goToPage(<?= $i ?>)"><?= $i ?></a></li>
                    <?php endfor ?>
                    <?php if ($page < $page_number) : ?>
                        <li><a href="javascript:void(0)" onclick="goToPage(<?= $page + 1 ?>)">Sau</a></li>
                    <?php endif ?>
                </ul>
                <!-- End paging -->
            </div>
        </div>
    </div>
</main>
<?php require 'layout/footer.php' ?>