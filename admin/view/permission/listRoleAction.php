<?php include "layout/header.php" ?>
<div id="content-wrapper">  
            <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Phân quyền</li>
        <li class="breadcrumb-item">
    		<a href="index.php?c=permission&a=listRole">Vai trò</a>
      	</li>
        <li class="breadcrumb-item"><?=$role->getName()?></li>
        <li class="breadcrumb-item active">Tác vụ</li>
    </ol>
    <!-- DataTables Example -->
    
    <!-- /form -->
    <form  method="post" action="index.php?c=permission&a=updateRoleAction" enctype="multipart/form-data">
        <div class="form-group row">
        	<input type="hidden" name="role_id" value="<?=$role->getId()?>" class="form-control input-md">
        	<?php foreach($actions as $action): ?>
         	<div class="col-md-9 col-lg-6">
            	<input type="checkbox" <?=in_array($action->getId(), $selected_actions) ? "checked" : ""?> name="action_ids[]" value="<?=$action->getId()?>" >
            	<?=$action->getDescription()?>							
            </div>
            <?php endforeach ?>             
        </div>
        <div class="form-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="update">
        </div>
    </form>
    <!-- /form -->
</div>
      <!-- /.content-wrapper -->
<?php include "layout/footer.php" ?>