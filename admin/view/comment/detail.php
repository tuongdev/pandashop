 <?php include "layout/header.php" ?>
 <div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="index.php">Quản lý</a>
         </li>
         <li class="breadcrumb-item ">Đánh giá</li>
         <li class="breadcrumb-item active"><?=$product->getName()?></li>
      </ol>
      <!-- DataTables Example -->
      <div class="action-bar">

         <label style="cursor: pointer;" for="delete" class="btn btn-danger btn-sm">Xóa</label>
      </div>
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
              <form action="index.php?c=comment&a=deletes" method="POST">
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th><input type="checkbox" onclick="checkAll(this)"></th>
                           <th>Email</th>
                           <th>Tên </th>
                           <th>Số sao</th>
                           <th>Ngày tạo</th>
                           <th>Nội dung</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($product->getComments() as $comment): ?>
                           <tr>
                              <td><input type="checkbox" name="ids[]" value="<?=$comment->getId()?>"></td>
                              <td><?=$comment->getEmail()?></td>
                              <td><?=$comment->getFullname()?></td>
                              <td><?=$comment->getStar()?></td>
                              <td><?=$comment->getCreatedDate()?></td>
                              <td><?=$comment->getDescription()?></td>
                              <td><a href="index.php?c=comment&a=delete&id=<?=$comment->getId()?>&product_id=<?=$product->getId()?>" class="btn btn-danger" onclick="return confirm('Bạn muốn xóa comment này hok?')">Xóa</a></td>
                           </tr>
                        <?php endforeach ?>
                     </tbody>
                  </table>
                  <input type="hidden" name="product_id" value="<?=$product_id?>">
                  <input type="submit" id="delete" hidden>
               </form>
               
            </div>
         </div>
      </div>
   </div>
   
</div>
<?php include "layout/footer.php" ?>