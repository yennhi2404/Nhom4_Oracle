<?php
  include "dbconnect.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <title>JobBoard &mdash; Free Website Template by Free-Template.co</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />
    <link rel="shortcut icon" href="ftco-32x32.png">
    
    <link rel="stylesheet" href="css/custom-bs.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/line-icons/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/quill.snow.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">    
    <style type="text/css">
      .button-box {
        position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px;display: block;
        font: bold 20px Tahoma;
        text-decoration: none;
        text-align: center;
        color: #333333;
        padding: 2px 6px 2px 6px;
        border-top: 1px solid ;
        border-right: 1px solid ;
        border-bottom: 1px solid ;
        border-left: 1px solid ;
      }
      section div div div a:hover { 
        background-color: #89ba16;
      }
    </style>
  </head>
  <body id="top">

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
    
<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    

    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="index.php">JobBoard</a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="index.php" class="nav-link active">Trang chủ</a></li>
              <li><a href="about.php">Thông tin</a></li>
              <li class="has-children">
                <a href="phantrang.php">Danh sách</a>
                <ul class="dropdown">
                  <?php
                    include "dbconnect.php";
                 ?>
                  <li><a href="chitiet.php?id=1">Công việc</a></li>
                  <li><a href="post-job.php">Đăng việc</a></li>
                </ul>
              </li>
              <li class="has-children">
                <a href="services.php">Trang</a>
                <ul class="dropdown">
                  <?php 
                    if(isset($_COOKIE['is_login'])){
                      $tendn = $_COOKIE['is_login'];
                      $loaiuser = oci_parse($conn,"SELECT ID_LOAI_USER FROM USERS WHERE NAME = '$tendn'");
                      oci_execute($loaiuser);
                      $flag = false;
                      while($row = oci_fetch_array($loaiuser)){
                        if($row[0]==1) $flag=true;
                      }
                      if($flag==true) echo '<li><a href="admin.php">Admin</a></li>';
                    } else echo '';          
                  ?>
                  <li><a href="services.php">Các dịch vụ</a></li>
                  <li><a href="service-single.php?idcc=1&hinh=1">Dịch vụ đơn</a></li>
                  <li><a href="portfolio.php">Danh mục đầu tư</a></li>
                  <li><a href="portfolio-single.php?iddd=5">Danh mục đầu tư đơn</a></li>
                  <li><a href="testimonials.php">Chứng thực</a></li>
                  <li><a href="faq.php">Đặt câu hỏi thường xuyên</a></li>
                  <li><a href="gallery.php">Thư viện</a></li>
                </ul>
              </li>
              <li><a href="blog.php">Blog</a></li>
              <li><a href="contact.php">Liên hệ</a></li>
              
              <?php 
                if(isset($_COOKIE['is_login'])){
                  echo '<li class="d-lg-none"><a href="post-job.php"><span class="mr-2">+</span> Đăng việc</a></li>                           
                  <li class="d-lg-none"><div>Xin chào'.$_COOKIE['is_login'].'</div></li>';
                }      
              ?>
            </ul>
          </nav>
          
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">
              <?php                                 
                if (!isset($_COOKIE['is_login'])) echo '<a href="login.php" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Đăng nhập</a>';                                
                else {
                  echo '<a href="post-job.php" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-add"></span>Đăng việc</a>
                        <a href="dangxuat.php" onClick=\'javascript: return confirm("Đăng xuất")\' class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span> Đăng xuất</a>
                        <div style="color:red">Xin chào <a href = "thaydoithongtincanhan.php" style="color:red">'.$_COOKIE['is_login'].'</a></div>';
                }
              ?>   
              
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>

        </div>
      </div>
    </header>
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Admin</h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Trang chủ</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Admin</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" style="background: url(images/crossword.png) repeat scroll 0 0 #89ba16">     
        <div class="container">
          <div class="row mb-5"> 
          <?php 
                    include "dbconnect.php";
                    $flag = false;
                    if(isset($_COOKIE['is_login'])){
                      $tendn = $_COOKIE['is_login'];
                      $loaiuser = oci_parse($conn,"SELECT ID_LOAI_USER FROM USERS WHERE NAME = '$tendn'");
                      oci_execute($loaiuser);
                      while($row = oci_fetch_array($loaiuser)){
                        if($row[0]==1) $flag=true;
                      }
                    }            
                    if($flag==false) echo "<p align='center' style='color:white;'>Bạn không có quyền Admin</p>";
                    if($flag==true)                       
                      echo '<div class="col-md-4 col-sm-12">
                        <a href="quanlyuser.php?page=1" style="text-decoration: none; color: white" class="button-box">
                          <div class="single-promo">                                    
                            <i class="fa fa-user fa-2x"></i>
                            <p>Quản lý tài khoản</p>                                    
                          </div>
                        </a><br>
                      </div> 
                      <div class="col-md-4 col-sm-12">
                        <a href="quanlycongviec.php?page=1" style="text-decoration: none; color: white" class="button-box">
                          <div class="single-promo">                                    
                            <i class="fa fa-book fa-2x"></i>
                            <p>Quản lý công việc</p>                                    
                          </div>
                        </a><br> 
                      </div>                        
                      <div class="col-md-4 col-sm-12">
                        <a href="quanlyblog.php?page=1" style="text-decoration: none; color: white" class="button-box">
                          <div class="single-promo">                                    
                            <i class="fa fa-desktop fa-2x"></i>
                            <p>Quản lý blog</p>                                    
                          </div>
                        </a><br>
                      </div> 
                      <br>
                      <div class="col-md-4 col-sm-12">
                        <a href="quanlythu.php?page=1" style="text-decoration: none; color: white" class="button-box">
                          <div class="single-promo">                                    
                            <i class="fa fa-envelope-o fa-2x"></i>
                            <p>Quản lý thư</p>                                    
                          </div>
                        </a><br>
                      </div> 
                      <div class="col-md-4 col-sm-12">
                        <a href="quanlydichvu.php?page=1" style="text-decoration: none; color: white" class="button-box">
                          <div class="single-promo">                                    
                            <i class="fa fa-send-o fa-2x"></i>
                            <p>Quản lý dịch vụ</p>                                    
                          </div>
                        </a><br>
                      </div> 
                      <div class="col-md-4 col-sm-12">
                        <a href="quanlyduan.php?page=1" style="text-decoration: none; color: white" class="button-box">
                          <div class="single-promo">                                    
                            <i class="fa fa-group fa-2x"></i>
                            <p>Quản lý dự án</p>                                    
                          </div>
                        </a><br>
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <a href="quanlychungthuc.php?page=1" style="text-decoration: none; color: white" class="button-box">
                          <div class="single-promo">                                    
                            <i class="fa fa-comment-o fa-2x"></i>
                            <p>Quản lý chứng thực</p>                                    
                          </div>
                        </a><br>
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <a href="quanlycauhoi.php?page=1" style="text-decoration: none; color: white" class="button-box">
                          <div class="single-promo">                                    
                            <i class="fa fa-question fa-2x"></i>
                            <p>Quản lý hỏi đáp</p>                                    
                          </div>
                        </a><br>
                      </div> 
                      <div class="col-md-4 col-sm-12">
                        <a href="quanlycongty.php?page=1" style="text-decoration: none; color: white" class="button-box">
                          <div class="single-promo">                                    
                            <i class="fa fa-bank fa-2x"></i>
                            <p>Quản lý công ty</p>                                    
                          </div>
                        </a><br>
                      </div> 
                      <div class="col-md-4 col-sm-12">
                        <a href="quanlykhac.php?page=1" style="text-decoration: none; color: white" class="button-box">
                          <div class="single-promo">                                    
                            <i class="fa fa-bars fa-2x"></i>
                            <p>Quản lý khác</p>                                    
                          </div>
                        </a><br>
                      </div>';
                      ?>  
              </div>             
          </div>     
    </section>
    
    <footer class="site-footer">

      <a href="#top" class="smoothscroll scroll-top">
        <span class="icon-keyboard_arrow_up"></span>
      </a>

      <div class="container">
        <div class="row mb-5">
          <div class="col-6 col-md-3 mb-4 mb-md-1">
            <h2 style="font-family:Tahoma; color:white">Xu hướng</h2>
            <ul class="list-unstyled">
                <li><a href="hangmuc.php?loai=photoshop&page=1">Photoshop </a></li>
                <li><a href="hangmuc.php?loai=html&page=1">HTML </a></li>
                <li><a href="hangmuc.php?loai=css&page=1">CSS </a></li>
                <li><a href="hangmuc.php?loai=php&page=1">PHP </a></li>
                <li><a href="hangmuc.php?loai=jquery&page=1">Jquery </a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h2 style="font-family:Tahoma; color:white">Công ty</h2>
            <ul class="list-unstyled">
              <li><a href="about.php">Thông tin</a></li>
              <li><a href="services.php">Dịch vụ</a></li>
              <li><a href="blog.php">Blog</a></li>
              <li><a href="gallery.php">Thư viện</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h2 style="font-family:Tahoma; color:white">Điều hướng</h2>
            <ul class="list-unstyled">
              <li><a href="thaydoithongtincanhan.php">Tài khoản</a></li>
              <li><a href="index.php">Tìm kiếm</a></li>
              <li><a href="faq.php">FAQ</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h2 style="font-family:Tahoma; color:white">JobBoard</h2>
            <p>Chúng tôi luôn luôn đem đến cho khách hàng những cơ hội trải nghiệm mới nhất từ các công ty có uy tín và nổi tiếng trên toàn thế giới. Hãy đăng ký tuyển dụng cùng chúng tôi, tại sao không?</p>
            <div class="footer-social">
              <a href="http://www.facebook.com"><span class="icon-facebook"></span></a>
              <a href="http://twitter.com"><span class="icon-twitter"></span></a>
              <a href="http://instagram.com"><span class="icon-instagram"></span></a>
              <a href="https://www.linkedin.com"><span class="icon-linkedin"></span></a>
            </div>
          </div>
        </div>

        <div class="row text-center">
          <div class="col-12">
            <p class="copyright">
            <!-- Link back to Free-Template.co can't be removed. Template is licensed under CC BY 3.0. -->
            <p class="block">&copy; <script>document.write(new Date().getFullYear());</script> <strong class="text-white">JobBoard</strong> Nhom 4. All Rights Reserved. <br> Designed &amp; Developed by Nhom 4</p>
            </p>
          </div>
        </div>
      </div>
    </footer>
  </div>

    <!-- SCRIPTS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/stickyfill.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/quill.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    
    <script src="js/custom.js"></script>
  </body>
</html>