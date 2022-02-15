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
      <!-- DataTables Example -->
      
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        
                        <th >Tỉnh/thành phố</th>
                        <th >Phí giao hàng</th>
                        <th>
                        </th>
                       
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach($transports as $transport): ?>
                     <tr>
                       
                        <td ><?=$transport->getProvince()->getName()?></td>
                        <td ><?=number_format($transport->getPrice())?> đ</td>
                        <td><a href="index.php?c=shippingfee&a=edit&id=<?=$transport->getId()?>" class="btn btn-warning btn-sm">Sửa</a></td>
                        
                     </tr>
                     <?php endforeach ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

</div>
<?php include "layout/footer.php" ?>