 <?php include "layout/header.php" ?>
 <div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="index.php">Quản lý</a>
         </li>
         <li class="breadcrumb-item">Hình ảnh</li>
         <li class="breadcrumb-item active"><?=$product->getName()?></li>
      </ol>
      <!-- DataTables Example -->
      <div class="action-bar">
         
         <label style="cursor: pointer;" for="delete" class="btn btn-danger btn-sm">Xóa</label>
      </div>
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
               <form action="index.php?c=imageItem&a=deletes" method="POST">
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th><input type="checkbox" onclick="checkAll(this)"></th>
                           <th>Hình ảnh</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach($product->getImageItems() as $imageItem) :?>
                        <tr>
                           <td><input type="checkbox" name="ids[]" value="<?=$imageItem->getId()?>"></td>
                           <td><img src="../upload/<?=$imageItem->getName()?>"></td>
                           <td><a href="index.php?c=imageItem&a=delete&id=<?=$imageItem->getId()?>&product_id=<?=$product->getId()?>" class="btn btn-danger" onclick="return confirm('Bạn muốn xóa hình này hok?')">Xóa</a></td>
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
      <form action="index.php?c=imageItem&a=save&id=<?=$product->getId()?>" method="POST" enctype="multipart/form-data">
         <div class="row">
            <div class="col-md-12">
               <label>Upload hình</label>
            </div>
         </div>
         
         <div class="row form-group">
            <div class="col-md-12">
               <input type="file" class="form-control" name="image" onchange="loadFile(event)">  
               <img src="" id="image" alt=""> 
            </div>
         </div>
         <div class="row form-group"> 
            <div class="col-md-12">
               <input type="submit" value="Upload" class="btn btn-primary btn-sm">
            </div>
         </div>
      </form>
   </div>
   
</div>
<?php include "layout/footer.php" ?>