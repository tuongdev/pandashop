<?php include "layout/header.php" ?>
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="index.php">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">News letter</li>
      </ol>
      <!-- DataTables Example -->
      <div class="action-bar">

         <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
      </div>
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th><input type="checkbox" onclick="checkAll(this)"></th>
                        <th>Email</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach($newsletters as $newsletter): ?>
                     <tr>
                        <td><input type="checkbox"></td>
                        <td><?=$newsletter->getEmail()?></td>
                        <td>
                           <a href="index.php?c=newsletter&a=delete&email=<?=$newsletter->getEmail()?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn muốn xóa email này phải không?')">Xóa</a></td>
                     </tr>
                     <?php endforeach ?>
                  </tbody>
               </table>
            </div>
         </div>

      </div>
   </div>
   <!-- /.container-fluid -->
   <!-- Sticky Footer -->

</div>
<?php include "layout/footer.php" ?>