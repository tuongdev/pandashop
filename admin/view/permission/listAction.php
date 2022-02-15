<?php include "layout/header.php" ?>
<div id="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="index.php">Quản lý</a>
			</li>
			<li class="breadcrumb-item active">Tác vụ</li>
		</ol>
		<!-- DataTables Example -->
		<div class="action-bar">
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th># </th>
								<th>Mã </th>
								<th>Tên</th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
							$stt = 0;
							foreach ($actions as $action): 
								$stt++;
							?>
							<tr>
								<td ><?=$stt?></td>
								<td ><?=$action->getName()?></td>
								<td ><?=$action->getDescription()?></td>
								
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