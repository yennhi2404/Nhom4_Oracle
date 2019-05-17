<?php
	include "dbconnect.php";
?>
<!DOCTYPE html>
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

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">    
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
    <section class="home-section section-hero overlay bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
              <h1 class="text-white font-weight-bold">Cách dễ nhất để có được công việc mơ ước</h1>
            </div>
            <form method="post" class="search-jobs-form">
              <div class="row mb-5">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <input type="text" class="form-control form-control-lg" placeholder="Việc làm..." name="TenViec">
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Vùng miền" name="Vung">
                    <?php
                      $result=oci_parse($conn,'SELECT "COUNTRY" FROM COUNTRIES');
                      oci_execute($result);
                      while($row= oci_fetch_row($result))
                          echo "<option>$row[0]</option>";
                    ?>
            	   </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Loại việc" name="LoaiViec">
                    <?php
                      $result=oci_parse($conn,'SELECT "JOB_TYPE" FROM JOB_TYPES');
                      oci_execute($result);
                      while($row= oci_fetch_row($result))
                          echo "<option>$row[0]</option>";
                    ?>
                  </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search" name="submit"><span class="icon-search icon mr-2"></span>Tìm việc</button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 popular-keywords">
                  <h3>Từ khóa:</h3>
                  <ul class="keywords list-unstyled m-0 p-0">
                    <li><a href="hangmuc.php?loai=MySQL&page=1" class="">MySQL</a></li>
                    <li><a href="hangmuc.php?loai=css&page=1" class="">CSS</a></li>
                    <li><a href="hangmuc.php?loai=MS Office&page=1" class="">MS Office</a></li>
                  </ul>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <a href="#next" class="scroll-button smoothscroll">
        <span class=" icon-keyboard_arrow_down"></span>
      </a>

    </section>
    
    <section class="py-5 bg-image overlay-primary fixed overlay" id="next" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2 text-white">Thống kê JobBoard</h2>
          </div>
        </div>
        <div class="row pb-0 block__19738 section-counter">

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="<?php
                  $result=oci_parse($conn,'SELECT COUNT(*) FROM USERS WHERE ID_LOAI_USER = 2');
                  oci_execute($result);
                  while($row= oci_fetch_row($result))
                    echo $row[0]; 
                ?>">0  
              </strong>
            </div>
            <span class="caption">Ứng cử viên</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="<?php
                  $result=oci_parse($conn,'SELECT COUNT(*) FROM JOBS');
                  oci_execute($result);
                  while($row= oci_fetch_row($result))
                    echo $row[0]; 
                ?>">0</strong>
            </div>
            <span class="caption">Việc làm</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="<?php
                  $result=oci_parse($conn,'SELECT COUNT(*) FROM COUNTRIES');
                  oci_execute($result);
                  while($row= oci_fetch_row($result))
                    echo $row[0]; 
                ?> ">0</strong>
            </div>
            <span class="caption">Quốc gia</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="<?php
                  $result=oci_parse($conn,'SELECT COUNT(*) FROM COMPANIES');
                  oci_execute($result);
                  while($row= oci_fetch_row($result))
                    echo $row[0]; 
                ?> ">0</strong>
            </div>
            <span class="caption">Công ty</span>
          </div>

            
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">Danh sách việc</h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">
         <?php 
          if(isset($_POST['Vung'])!="" && isset($_POST['LoaiViec'])!="" && isset($_POST['TenViec'])!="" && isset($_POST['submit'])!=""){
              $TenViec=$_POST['TenViec'];
              $Vung = $_POST['Vung'];
              $LoaiViec = $_POST['LoaiViec'];

              $sql_search="SELECT TITLE,COUNTRY,JOB_TYPE,c.NAME,NAMEIMG from JOBS JOIN COUNTRIES ON COUNTRIES.ID = JOBS.COUNTRY_ID 
              JOIN JOB_TYPES ON JOBS.JOB_TYPE_ID=JOB_TYPES.ID JOIN COMPANIES c ON JOBS.COMPANY_ID = c.ID where lower(TITLE) LIKE lower('%$TenViec%') and lower(COUNTRY) LIKE lower('%$Vung%') and lower(JOB_TYPE) LIKE lower('%$LoaiViec%')";
            $run=oci_parse($conn,$sql_search);
            oci_execute($run);

          while($row=oci_fetch_array($run)){
          ?>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php"></a>
            <div class="job-listing-logo">
              <img src="images/<?php echo $row[4]?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?php echo $row[0]; ?></h2>
                <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase mr-2"></span><?php echo $row[3]; ?></span>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span><?php echo $row[1]; ?>
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-success"><?php echo $row[2]; ?></span>
              </div>
            </div>
          </li>  
            <?php
              }}
              oci_close($conn);
            ?> 
        </ul>
        
        <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span>Hiển thị <?php if(isset($_POST['submit'])!="") echo oci_num_rows($run); else echo ''; ?> công việc</span>
          </div>
        </div>
      </div>
    </section>         

    <section class="site-section py-4">
      <div class="container">
  
        <div class="row align-items-center">
          <div class="col-12 text-center mt-4 mb-5">
            <div class="row justify-content-center">
              <div class="col-md-7">
                <h2 class="section-title mb-2">Công ty chúng tôi đã từng giúp đỡ</h2>
                <p class="lead">Các doanh nghiệp lớn nhỏ trong và ngoài nước trong việc hỗ trợ, tìm kiếm nhân lực.</p>
              </div>
            </div>
            
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_mailchimp.svg" alt="Image" class="img-fluid logo-1">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_paypal.svg" alt="Image" class="img-fluid logo-2">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_stripe.svg" alt="Image" class="img-fluid logo-3">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_visa.svg" alt="Image" class="img-fluid logo-4">
          </div>

          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_apple.svg" alt="Image" class="img-fluid logo-5">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_tinder.svg" alt="Image" class="img-fluid logo-6">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_sony.svg" alt="Image" class="img-fluid logo-7">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_airbnb.svg" alt="Image" class="img-fluid logo-8">
          </div>
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
    
    <script src="js/bootstrap-select.min.js"></script>
    
    <script src="js/custom.js"></script>

     
  </body>
</html>