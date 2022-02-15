<?php include "layout/header.php" ?>
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="index.php">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Nhân viên</li>
      </ol>
      <!-- /form -->
      <form method="post" action="index.php?c=staff&a=save" enctype="multipart/form-data">
         <div class="form-group row">
            <label class="col-md-12 control-label" for="fullname">Họ Và Tên</label>  
            <div class="col-md-9 col-lg-6">
               <input name="fullname" id="fullname" type="text" value="" class="form-control">                        
            </div>
         </div>
         <div class="form-group row">
            <label class="col-md-12 control-label" for="username">Tên Đăng Nhập</label>  
            <div class="col-md-9 col-lg-6">                           
               <input name="username" id="username" type="text" value="" class="form-control">                        
            </div>
         </div>
         <div class="form-group row">
            <label class="col-md-12 control-label" for="password">Mật Khẩu</label>  
            <div class="col-md-9 col-lg-6">                           
               <input name="password" id="password" type="password" value="" class="form-control">                      
            </div>
         </div>
         <div class="form-group row">
            <label class="col-md-12 control-label" for="mobile">Số Điện Thoại</label>  
            <div class="col-md-9 col-lg-6">                           
               <input name="mobile" id="mobile" type="text" value="" class="form-control">                       
            </div>
         </div>
         <div class="form-group row">
            <label class="col-md-12 control-label" for="email">Email</label>  
            <div class="col-md-9 col-lg-6">                           
               <input name="email" id="email" type="text" value="" class="form-control">                      
            </div>
         </div>
         <div class="form-group row">
            <label class="col-md-12 control-label" for="role">Vai trò</label>  
            <div class="col-md-9 col-lg-6">
               <select name="role_id" class="form-control">
                  <?php foreach($roles as $role): ?>
                  <option value="<?=$role->getId()?>"><?=$role->getName()?></option>
                  <?php endforeach ?>
               </select>
            </div>
         </div>
         <div class="form-group row">
            <div class="col-md-12">
               <input type="checkbox" value="1" name="is_active" checked> Kích hoạt
            </div>
            
         </div>
         <div class="form-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
         </div>
      </form>
      <!-- /form -->
   </div>
   <!-- /.container-fluid -->
   <!-- Sticky Footer -->

</div>
<?php include "layout/footer.php" ?>