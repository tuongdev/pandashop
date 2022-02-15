<?php include "layout/header.php" ?>
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="index.php">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Danh mục</li>
      </ol>
      <!-- DataTables Example -->
      <div class="action-bar">
         <a class="btn btn-primary btn-sm" href="index.php?c=category&a=add">Thêm</a>
         <label style="cursor: pointer; margin-bottom: 0" for="delete" class="btn btn-danger btn-sm">Xóa</label>
      </div>
      <div class="card mb-3">
         <div class="card-body">

            <div class="table-responsive">
               <form action="index.php?c=category&a=deletes" method="POST">

                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th><input type="checkbox" onclick="checkAll(this)"></th>
                           <th >Tên</th>
                           <th>
                           </th>
                           <th>
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($categories as $category): 
                          
                        ?>
                        <tr>
                          <td>
                           <input type="checkbox" name="ids[]" value="<?=$category->getId()?>">
                           </td>
                           <td ><?=$category->getName()?></td>
                           <td><a href="index.php?c=category&a=edit&id=<?=$category->getId()?>" class="btn btn-warning btn-sm">Sửa</a></td>
                            <td>
                              <a data="<?=$category->getId()?>" href="index.php?c=category&a=delete&id=<?=$category->getId()?>" class="btn btn-danger btn-sm btn-delete-cat">Xóa</a>
                           </td>
                        </tr>
                        <?php endforeach ?>
                        
                     </tbody>
                  </table>
                  <input type="submit" id="delete" hidden>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include "layout/footer.php" ?>