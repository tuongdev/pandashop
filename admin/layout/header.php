<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title><?=!empty($page_title) ? $page_title : "Tổng quan" ?></title>
      <!-- Create favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="../upload/logo.jpg" />
      <!-- Custom fonts for this template-->
      <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <!-- Page level plugin CSS-->
      <link href="public/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="public/css/sb-admin.css" rel="stylesheet">
      <link href="public/css/admin.css" rel="stylesheet">
   </head>
   <body id="page-top">
      <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
         <a class="navbar-brand mr-1" href="index.html">Mỹ Phẩm YouT</a>
         <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
         <i class="fas fa-bars"></i>
         </button>
         <!-- Navbar Search -->
         <!-- Navbar -->
         <ul class="navbar-nav ml-auto">
            <li class="nav-item no-arrow text-white">
               <span >Chào <?=$_SESSION["name"]?></span> |
               <a class="text-white nounderline" href="#" data-toggle="modal" data-target="#logoutModal">Thoát</a>
            </li>
         </ul>
      </nav>
      <div id="wrapper">
         <?php 
         global $c, $a;
         ?>
         <!-- Sidebar -->
         <ul class="sidebar navbar-nav">
            <li class="nav-item <?=$c=="dashboard" ? "active": ""?>">
               <a class="nav-link" href="index.php"><i class="fas fa-fw fa-tachometer-alt"></i> <span>Tổng quan</span></a>
            </li>
            <li class="nav-item dropdown <?=$c=="order" ? "active": ""?>">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-shopping-cart"></i> <span>Đơn hàng</span></a>
               <div class="dropdown-menu <?=$c=="order" ? "show": ""?>" aria-labelledby="">
                  <a class="dropdown-item <?=$c=="order" && $a=="list" ? "active": ""?>" href="index.php?c=order">Danh sách</a>
                  <a class="dropdown-item <?=$c=="order" && $a=="add" ? "active": ""?>" href="index.php?c=order&a=add">Thêm</a>
               </div>
            </li>
            <li class="nav-item dropdown <?=$c=="product" ? "active": ""?>">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fab fa-product-hunt"></i> <span>Sản phẩm</span></a>
               <div class="dropdown-menu <?=$c=="product" ? "show": ""?>" aria-labelledby="">
                  <a class="dropdown-item <?=$c=="product" && $a=="list" ? "active": ""?>" href="index.php?c=product">Danh sách</a>
                  <a class="dropdown-item <?=$c=="product" && $a=="add" ? "active": ""?>" href="index.php?c=product&a=add">Thêm</a>
               </div>
            </li>
            <li class="nav-item dropdown <?=$c=="comment" ? "active": ""?>">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-comments"></i> <span>Comment</span></a>
               <div class="dropdown-menu <?=$c=="comment" ? "show": ""?>" aria-labelledby="">
                  <a class="dropdown-item <?=$c=="comment" ? "active": ""?>" href="index.php?c=comment">Danh sách</a>
               </div>
            </li>

            <li class="nav-item dropdown <?=$c=="imageItem" ? "active": ""?>">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="far fa-image"></i> <span>Hình ảnh</span></a>
               <div class="dropdown-menu <?=$c=="imageItem" ? "show": ""?>" aria-labelledby="">
                  <a class="dropdown-item <?=$c=="imageItem" ? "active": ""?>" href="index.php?c=imageItem">Danh sách</a>
               </div>
            </li>
            <li class="nav-item dropdown <?=$c=="customer" ? "active": ""?>">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-folder"></i> <span>Khách hàng</span></a>
               <div class="dropdown-menu <?=$c=="customer" ? "show": ""?>" aria-labelledby="">
                  <a class="dropdown-item <?=$c=="customer" && $a=="list"  ? "active": ""?> " href="index.php?c=customer">Danh sách</a>
                  <a class="dropdown-item <?=$c=="customer" && $a=="add" ? "active": ""?>" href="index.php?c=customer&a=add">Thêm</a>
               </div>
            </li>
            <li class="nav-item dropdown <?=$c=="category" ? "active": ""?>">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-folder"></i> <span>Danh mục</span></a>
               <div class="dropdown-menu <?=$c=="category" ? "show": ""?>" aria-labelledby="">
                  <a class="dropdown-item <?=$c=="category" && $a=="list"  ? "active": ""?> " href="index.php?c=category">Danh sách</a>
                  <a class="dropdown-item <?=$c=="category" && $a=="add" ? "active": ""?>" href="index.php?c=category&a=add">Thêm</a>
               </div>
            </li>
            <li class="nav-item dropdown <?=$c=="brand" ? "active": ""?>">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-folder"></i> <span>Nhãn hiệu</span></a>
               <div class="dropdown-menu <?=$c=="brand" ? "show": ""?>" aria-labelledby="">
                  <a class="dropdown-item <?=$c=="brand" && $a=="list"  ? "active": ""?> " href="index.php?c=brand">Danh sách</a>
                  <a class="dropdown-item <?=$c=="brand" && $a=="add" ? "active": ""?>" href="index.php?c=brand&a=add">Thêm</a>
               </div>
            </li>
            <li class="nav-item <?=$c=="shippingfee" ? "active": ""?>">
               <a class="nav-link" href="index.php?c=shippingfee"><i class="fas fa-shipping-fast"></i> <span>Phí giao hàng</span></a>
            </li>

            <li class="nav-item dropdown <?=$c=="staff" ? "active": ""?>">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-users"></i> <span>Nhân viên</span></a>
               <div class="dropdown-menu <?=$c=="staff" ? "show": ""?>" aria-labelledby="">
                  <a class="dropdown-item <?=$c=="staff" && $a=="list"  ? "active": ""?> " href="index.php?c=staff">Danh sách</a>
                  <a class="dropdown-item <?=$c=="staff" && $a=="add" ? "active": ""?>" href="index.php?c=staff&a=add">Thêm</a>
               </div>
            </li>

            <li class="nav-item dropdown <?=$c=="permission" ? "active": ""?>">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-user-shield"></i> <span>Phân quyền</span></a>
               <div class="dropdown-menu <?=$c=="permission" ? "show": ""?>" aria-labelledby="">
                  <a class="dropdown-item <?=$c=="permission" && $a=="listRole"  ? "active": ""?> " href="index.php?c=permission&a=listRole">Danh sách vai trò</a>
                  <a class="dropdown-item <?=$c=="permission" && $a=="addRole" ? "active": ""?>" href="index.php?c=permission&a=addRole">Thêm vai trò</a>
                  <a class="dropdown-item <?=$c=="permission" && $a=="listAction"  ? "active": ""?> " href="index.php?c=permission&a=listAction">Danh sách tác vụ</a>
               </div>
            </li>

            
            <li class="nav-item <?=$c=="status" ? "active": ""?>">
               <a class="nav-link" href="index.php?c=status"><i class="fas fa-star-half-alt"></i> <span>Trạng thái đơn hàng</span></a>
            </li>

            <li class="nav-item dropdown <?=$c=="newsletter" ? "active": ""?>">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-file-alt"></i> <span>News letter</span></a>
               <div class="dropdown-menu <?=$c=="newsletter" ? "show": ""?>" aria-labelledby="">
                  <a class="dropdown-item <?=$c=="newsletter" && $a=="list"  ? "active": ""?> " href="index.php?c=newsletter">Danh sách</a>
                  <a class="dropdown-item <?=$c=="newsletter" && $a=="sendEmail" ? "active": ""?>" href="index.php?c=newsletter&a=sendEmail">Gởi mail</a>
               </div>
            </li>

            
         </ul>
         <div class="message bg-info text-center" style="position: absolute; left:50%; transform: translateX(-50%);width:100%"><?=!empty($_SESSION["message"]) ? $_SESSION["message"] : ""?></div>
         <?php 
            unset($_SESSION["message"]);
         ?>

         <div class="error bg-danger text-center" style="position: absolute; left:50%; transform: translateX(-50%);width:100%; color:white"><?=!empty($_SESSION["error"]) ? $_SESSION["error"] : ""?></div>
         <?php 
            unset($_SESSION["error"]);
         ?>