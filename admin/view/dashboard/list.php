<?php  include "layout/header.php"; ?>
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item active">Tổng quan</li>
      </ol>
      <?php 
      $type = !empty($_GET["type"]) ? $_GET["type"] : "today";
      ?>
      <div class="mb-3 my-3">
         <a href="index.php?type=today&from_date=<?=date("Y-m-d")?>&to_date=<?=date("Y-m-d")?>" class="<?=$type=="today" ? "active": ""?> btn btn-primary">Hôm nay</a>
         <a href="index.php?type=yesterday&from_date=<?=date("Y-m-d",strtotime("-1 days"))?>&to_date=<?=date("Y-m-d", strtotime("-1 days"))?>" class="<?=$type=="yesterday" ? "active": ""?> btn btn-primary">Hôm qua</a>
         <a href="index.php?type=thisweek&from_date=<?=date("Y-m-d",strtotime("this week"))?>&to_date=<?=date("Y-m-d")?>" class="<?=$type=="thisweek" ? "active": ""?> btn btn-primary">Tuần này</a>
         <a href="index.php?type=thismonth&from_date=<?=date("Y-m-d",strtotime("this month"))?>&to_date=<?=date("Y-m-d")?>" class="<?=$type=="thismonth" ? "active": ""?> btn btn-primary">Tháng này</a>
         <a href="index.php?type=3months&from_date=<?=date("Y-m-d",strtotime("-3 months"))?>&to_date=<?=date("Y-m-d")?>" class="<?=$type=="3months" ? "active": ""?> btn btn-primary">3 tháng</a>
         <a href="index.php?type=thisyear&from_date=<?=date("Y-01-01")?>&to_date=<?=date("Y-m-d")?>" class="<?=$type=="thisyear" ? "active": ""?> btn btn-primary">Năm này</a>
         <div class="dropdown" style="display:inline-block">
            <a class="<?=$type=="custom" ? "active" : ""?> btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
               <div style="margin:20px">
                  <form action="index.php">
                     Từ ngày <input type="date" class="form-control" name="from_date" required value="<?=$type == "custom" ? $_GET["from_date"]: ""?>">
                     Đến ngày <input type="date" class="form-control" name="to_date" required value="<?=$type == "custom" ? $_GET["to_date"]: ""?>">
                     <br>
                     <input type="hidden" value="custom" name="type">
                     <input type="submit" value="Tìm" class="btn btn-primary form-control">
                  </form>
                  
               </div>
            </div>
         </div>
      </div>
      <!-- Icon Cards-->
      <div class="row">
         <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
               <div class="card-body">
                  <div class="card-body-icon">
                     <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5"><?=count($orders)?> Đơn hàng</div>
               </div>
               <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">Chi tiết</span>
                  <span class="float-right">
                     <i class="fas fa-angle-right"></i>
                  </span>
               </a>
            </div>
         </div>
         <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
               <div class="card-body">
                  <div class="card-body-icon">
                     <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>

                  <?php 
                  $revenue = 0;
                  $cancel_number = 0;
                  foreach ($orders as $order):
                     if ($order->getStatusId() == 6) {
                        $cancel_number++;
                     }
                     $orderItems = $order->getOrderItems();
                     foreach($orderItems as $orderItem) {
                        $revenue += $orderItem->getTotalPrice();
                     }
                     $revenue += $order->getShippingFee();
                  endforeach
                  ?>

                  <div class="mr-5">Doanh thu <?=number_format($revenue)?> đ</div>
               </div>
               <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">Chi tiết</span>
                  <span class="float-right">
                     <i class="fas fa-angle-right"></i>
                  </span>
               </a>
            </div>
         </div>
         <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
               <div class="card-body">
                  <div class="card-body-icon">
                     <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5"><?=$cancel_number?> đơn hàng bị hủy</div>
               </div>
               <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">Chi tiết</span>
                  <span class="float-right">
                     <i class="fas fa-angle-right"></i>
                  </span>
               </a>
            </div>
         </div>
      </div>
      <!-- DataTables Example -->
      <div class="card mb-3">
         <div class="card-header">
            <i class="fas fa-table"></i>
            Đơn hàng
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <?php include "layout/orders.php" ?>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
<!-- Sticky Footer -->
<?php  include "layout/footer.php"; ?>
