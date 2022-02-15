<?php include "layout/header.php" ?>
<div id="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="index.php">Quản lý</a>
			</li>
			<li class="breadcrumb-item active">Sản phẩm</li>
		</ol>
		<!-- /form -->
		<form method="post" action="index.php?c=product&amp;a=save" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="col-md-12 control-label" for="barcode">Barcode </label>  
				<div class="col-md-9 col-lg-6">
					<input name="barcode" id="barcode" type="text" value="" class="form-control">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="sku">SKU </label>  
				<div class="col-md-9 col-lg-6">
					<input name="sku" id="sku" type="text" value="" class="form-control">
				</div>
			</div>

			<div class="row form-group">
				<label class="col-md-12 control-label" for="name">Tên </label>  
				<div class="col-md-9 col-lg-6">
					<input name="name" id="name" type="text" value="" class="form-control">                       
				</div>
			</div>

			<div class="form-group row">

				<div class="col-md-9 col-lg-6">
					<input type="file" name="image" onchange="loadFile(event)">  
					<img src="" id="image" alt="">            
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="price">Giá</label>  
				<div class="col-md-9 col-lg-6">
					<input name="price" id="price" type="text" value="" class="form-control">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="discount_percentage">% Giảm giá</label>  
				<div class="col-md-9 col-lg-6">
					<input name="discount_percentage" id="discount_percentage" type="text" value="" class="form-control">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="discount_from_date">Giảm giá từ</label>  
				<div class="col-md-9 col-lg-6">
					<input name="discount_from_date" id="discount_from_date" type="date" value="" class="form-control">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="discount_to_date">Giảm giá đến</label>  
				<div class="col-md-9 col-lg-6">
					<input name="discount_to_date" id="discount_to_date" type="date" value="" class="form-control">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="inventory_qty">Lượng tồn</label>  
				<div class="col-md-9 col-lg-6">
					<input name="inventory_qty" id="inventory_qty" type="text" value="" class="form-control">			
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label">Nổi bật</label>  
				<div class="col-md-9 col-lg-6">
					<input name="featured" id="featured" type="checkbox" value="1">			
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="category">Danh mục</label>  
				<div class="col-md-9 col-lg-6">
					<select name="category" id="category" class="form-control">
						<option value="">Vui lòng chọn danh mục</option>
						<?php foreach ($categories as $category): ?>
						<option value="<?=$category->getId()?>"><?=$category->getName()?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="brand">Nhãn hàng</label>  
				<div class="col-md-9 col-lg-6">
					<select name="brand" id="brand" class="form-control">
						<option value="">Vui lòng chọn nhãn hàng</option>
						<?php foreach ($brands as $brand): ?>
						<option value="<?=$brand->getId()?>"><?=$brand->getName()?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>



			<div class="form-group row">
				<label class="col-md-12 control-label" for="description">Mô tả</label>  
				<div class="col-md-12">
					<textarea name="description" id="description" rows="10" cols="80" style="">
					</textarea>
				</div>

			</div>
			<div class="form-action">
				<input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
			</div>
		</form>
		<script type="text/javascript" src="public/vendor/ckeditor/ckeditor.js"></script>
		<script>CKEDITOR.replace('description');</script>
		<!-- /form -->
		<!-- /.container-fluid -->
		<!-- Sticky Footer -->
	</div>
	<!-- /.content-wrapper -->
</div>

<?php include "layout/footer.php" ?>