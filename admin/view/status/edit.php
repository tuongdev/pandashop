<?php include "layout/header.php" ?>
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="index.php">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Trạng thái đơn hàng</li>
      </ol>
      <!-- /form -->
      <form class="form-horizontal" method="POST" action="index.php?c=status&a=update" enctype="multipart/form-data">
         <div class="form-group">
            <label class="col-md-9 col-lg-6 control-label" for="name">Mô tả (<?=$status->getName()?>)</label>  
            <div class="col-md-9 col-lg-6">
               <input type="hidden" name="id" value="<?=$status->getId()?>" class="form-control">
               <input name="description" id="name" type="text" value="<?=$status->getDescription()?>" class="form-control">								
            </div>
         </div>
         <div class="form-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="update">
         </div>
      </form>
      <!-- /form -->
   </div>
   <!-- /.container-fluid -->

</div>
<?php include "layout/footer.php" ?>