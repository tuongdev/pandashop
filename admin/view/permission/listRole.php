<?php include "layout/header.php" ?>
<div id="content-wrapper">
            <div class="container-fluid">
               <!-- Breadcrumbs-->
               <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                     <a href="index.php">Quản lý</a>
                  </li>
                  <li class="breadcrumb-item active">Vai trò</li>
               </ol>
               <!-- DataTables Example -->
               <div class="action-bar">
                  <a href="index.php?c=permission&a=addRole" class="btn btn-primary btn-sm">Thêm</a>
                  
               </div>
               <div class="card mb-3">
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           
                          <th >Tên </th>
                          <th></th>
                          <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach($roles as $role): ?>
                        <tr>
                           
                           <td >
                              <a title="Danh sách tác vụ" href="index.php?c=permission&a=listRoleAction&id=<?=$role->getId()?>"><?=$role->getName()?></a>
                           </td>
                           <td><a href="index.php?c=permission&a=editRole&id=<?=$role->getId()?>" class="btn btn-warning btn-sm">Sửa</a></td>
                            <td>
                              <a data="<?=$role->getId()?>" href="index.php?c=permission&a=deleteRole&id=<?=$role->getId()?>" class="btn btn-danger btn-sm btn-delete-role">Xóa</a>
                           </td>
                        </tr>
                        <?php endforeach; ?>
                     </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            
         </div>
<?php include "layout/footer.php" ?>