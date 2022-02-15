<?php  include "layout/header.php" ?>
<div id="content-wrapper">
  <div class="container-fluid">
   <!-- Breadcrumbs-->
   <ol class="breadcrumb">
    <li class="breadcrumb-item">
     <a href="index.php">Quản lý</a>
   </li>
   <li class="breadcrumb-item active">Trạng thái đơn hàng</li>
 </ol>
 <!-- DataTables Example -->
 <div class="card mb-3">
  <div class="card-body">
   <div class="table-responsive">
    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
     <thead>
      <tr>
        <th>#</th>
        <th>Tên</th>
        <th>Mô tả</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($statuses as $status): ?>
      <tr>
       <td><?=$status->getId()?></td>
       <td><?=$status->getName()?></td>
       <td><?=$status->getDescription()?></td>
       <td>
         <a href="index.php?c=status&a=edit&id=<?=$status->getId()?>" class="btn btn-warning btn-sm">Sửa</a>
       </td>
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
<?php  include "layout/footer.php" ?>