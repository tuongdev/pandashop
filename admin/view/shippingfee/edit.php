<?php include "layout/header.php" ?>
<div id="content-wrapper">
  <div class="container-fluid">
   <!-- Breadcrumbs-->
   <ol class="breadcrumb">
    <li class="breadcrumb-item">
     <a href="index.php">Quản lý</a>
   </li>
   <li class="breadcrumb-item active">Giao hàng</li>
 </ol>
 <!-- /.row -->
 <!-- form -->
   <form method="POST" action="index.php?c=shippingfee&a=update" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$transport->getId()?>">
    <div class="form-group">
      <div class="col-md-9 col-lg-6">
        <label class="control-label" for=""><?=$transport->getProvince()->getName() ?>  </label>                   
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-9 col-lg-6 control-label" for="price">Phí giao hàng</label>  
      <div class="col-md-9 col-lg-6"> 
        <input name="price" id="price" type="text" value="<?=$transport->getPrice()?>" class="form-control">                        
      </div>
    </div>
    <div class="form-action">
      <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="edit">
    </div>
  </form>
<!-- /form -->
</div>
<!-- /.container-fluid -->

</div>
<?php include "layout/footer.php" ?>