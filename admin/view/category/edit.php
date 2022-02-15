<?php include "layout/header.php" ?>
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="index.php">Quản lý</a>
         </li>
         <li class="breadcrumb-item">Danh mục</li>
         <li class="breadcrumb-item active"><?=$category->getName()?></li>
      </ol>
      <!-- /form -->
      <form method="POST" action="index.php?c=category&a=update">
         <div class="form-group row">
            <label class="col-md-12 control-label" for="name">Tên</label>  
            <div class="col-md-9 col-lg-6">
               <input type="hidden" name="id" value="<?=$category->getId()?>" class="form-control">
               <input name="name" id="name" type="text" value="<?=$category->getName()?>" class="form-control">                       
            </div>
         </div>
         <div class="form-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="update">
         </div>
      </form>
      <!-- /form -->
   </div>
   <!-- /.container-fluid -->
   <!-- Sticky Footer -->

</div>
<?php include "layout/footer.php" ?>