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
      <!-- DataTables Example -->
      <div class="action-bar">
         <a class="btn btn-primary btn-sm" href="index.php?c=staff&a=add">Thêm</a>
         <label style="cursor: pointer; margin-bottom: 0" for="activeMulti" class="btn btn-primary btn-sm">Kích hoạt</label>
         <label style="cursor: pointer; margin-bottom: 0" for="disableMulti" class="btn btn-danger btn-sm">Vô hiệu</label>
      </div>
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
              <form action="index.php?c=staff&a=activeOrDisableMulti" method="POST">

                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                      <tr>
                       <th><input type="checkbox" onclick="checkAll(this)"></th>
                       <th >Tên </th>
                       <th >Tên đăng nhập</th>
                       <th >Email</th>
                       <th >Số điện thoại</th>
                       <th> Vai trò </th>
                       <th></th>
                       <th></th>
                    </tr>
                 </thead>
                 <tbody>
                    <?php foreach ($staffs as $staff): ?>
                   <tr>
                     <td><input type="checkbox" name="ids[]" value="<?=$staff->getId()?>"></td>
                     <td ><?=$staff->getName()?></td>
                     <td ><?=$staff->getUsername()?></td>
                     <td ><?=$staff->getEmail()?></td>
                     <td ><?=$staff->getMobile()?></td>
                     <td><?=$staff->getRole()->getName()?></td>
                     <td>
                      <a href="index.php?c=staff&a=edit&id=<?=$staff->getId()?>" class="btn btn-warning btn-sm">Sửa</a>
                    </td>
                     <td >
                      <?php if ($staff->getIsActive() == 1): ?>
                       <a href="index.php?c=staff&a=disable&id=<?=$staff->getId()?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn muốn vô hiệu hóa viên này')">Vô hiệu</a>
                       <?php else: ?>
                        <a href="index.php?c=staff&a=active&id=<?=$staff->getId()?>" class="btn btn-primary btn-sm">Kích hoạt</a>
                      <?php endif ?>
                    </td>
                  </tr>
                  <?php endforeach ?>
                 </tbody>
              </table>

                <input type="submit" id="activeMulti" name="activeMulti" hidden>
                <input type="submit" id="disableMulti" name="disableMulti" hidden>
              </form>
               
       </div>
    </div>
 </div>
</div>
<!-- /.container-fluid -->
<!-- Sticky Footer -->

</div>
<?php include "layout/footer.php" ?>