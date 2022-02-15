<?php include "layout/header.php" ?>
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php?c=order&a=list">Đơn hàng</a>
            </li>
            <li class="breadcrumb-item active">Thêm đơn hàng</li>
        </ol>
        <form class="spacing" method="POST" action="index.php?c=order&a=save" enctype="multipart/form-data">
            <div class="row ">
                <div class="col-sm-4 col-lg-2">
                    <label>Tên khách hàng:</label>  
                </div>
                <div class="col-sm-8 col-lg-6">
                    <select name="customer" class="chosen-customer form-control" required>
                        <option value="">Chọn khách hàng</option>
                        <?php foreach ($customers as $customer): ?>
                        <option value="<?=$customer->getId()?>"><?=$customer->getName()?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Trạng thái:</label>  
                </div>
                <div class="col-sm-8 col-lg-6">
                    <select name="status" class="form-control">
                    	<?php foreach ($statuses as $status): ?>
                        <option <?=$status->getId()==5 ? "selected" : ""?> value="<?=$status->getId()?>" ><?=$status->getDescription()?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Người nhận</label>  
                </div>
                <div class="col-sm-8 col-lg-6"> 
                    <input type="text" name="shipping_name" value="" class="shipping-name form-control">                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Số điện thoại người nhận</label>  
                </div>
                <div class="col-sm-8 col-lg-6"> 
                    <input type="text" name="shipping_mobile" value="" class="shipping-mobile form-control">                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Hình thức thanh toán</label>  
                </div>
                <div class="col-sm-8 col-lg-6">
                    <select name="payment_method" class="form-control">
                        <option selected value="0">COD</option>
                        <option value="1">Bank</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2">
                    <label>Địa chỉ giao hàng</label>  
                </div>
            	
            	<div class="col-sm-8 col-lg-10">
            		<div class="row">
            			<?php include "layout/address_variable.php" ?>
       					<?php include "layout/address_layout.php" ?>
       					<div class="col-sm-3">
                   
		                    <input name="housenumber_street" class="form-control housenumber_street" type="text" value="" required>
		                </div>
            		</div>
            	</div>
  
       			
            </div>
                
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Ngày giao hàng</label>  
                </div>
                <div class="col-sm-8 col-lg-6"> 
                    <input type="date" name="delivered_date" value="<?=date("Y-m-d")?>" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Nhân viên phụ trách</label>  
                </div>
                <div class="col-sm-8 col-lg-6">
                    <select name="staff" class="form-control">
                    	<?php foreach($staffs as $staff): ?>
                        <option <?=$_SESSION["username"]==$staff->getUsername() ? "selected":"" ?> value="<?=$staff->getId()?>"><?=$staff->getName()?></option>
                       	<?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Tạm tính:</label>  
                </div>
                <div class="col-sm-8 col-lg-6"> 
                    <span class="sub-total" data="0">đ</span>							
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Phí giao hàng:</label>  
                </div>
                <div class="col-sm-8 col-lg-6"> 
                    <input name="shipping_fee" class="shipping-fee form-control" type="number" value="" required>					
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Tổng cộng:</label>  
                </div>
                <div class="col-sm-8 col-lg-6"> 
                    <span class="payment-total">đ</span>							
                </div>
            </div>
            <label class="control-label">Sản phẩm</label>  
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label for="search-barcode">Nhập barcode: </label> 
                </div>
                <div class="col-sm-8 col-lg-6">
                    <input type="number" name="search-barcode" id="search-barcode" class="form-control">
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover product-item" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-action">
                <a href="index.php?c=order" class="btn btn-info btn-sm">Hủy</a>
                <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
            </div>
            <br>
        </form>
    </div>
    <!-- /.content-wrapper -->
</div>
<?php include "layout/footer.php" ?>