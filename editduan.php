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
     <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Dự án</h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Trang chủ</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Dự án</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section class="site-section">
      <div class="container">
        <?php           
          include "dbconnect.php";
          $flag = false;
          if(isset($_COOKIE['is_login'])){
            $tendn = $_COOKIE['is_login'];
            $loaiuser = oci_parse($conn,"SELECT ID_LOAI_USER FROM USERS WHERE NAME = '$tendn'");
            oci_execute($loaiuser);
            while($r = oci_fetch_array($loaiuser)){
              if($r[0]==1) $flag=true;
            }
          }            
        if($flag==false) echo "<p align='center' style='color:red;'>Bạn không có quyền Admin</p>";
        if($flag==true){  
        $idda = $_REQUEST["id"];
        $sql = oci_parse($conn,"SELECT USER_ID,NAME,DESCRIPTION,URL,TO_CHAR(DATE_START,'DD-MM-YYYY HH24:MI:SS'),TO_CHAR(DATE_END,'DD-MM-YYYY HH24:MI:SS') FROM PROFILE_PROJECTS WHERE ID = '$idda'"); //Lấy thông tin dự án có mã id tương ứng
    oci_execute($sql);
      while($row = oci_fetch_array($sql)){
                $idnguoidk = $row[0];
                $tenda = $row[1];
                $noidung = $row[2]->load();
                $url = $row[3];
                $ngaybatdau = $row[4];
                $ngayketthuc = $row[5];
            }

        function test_input($data){ //Hàm này dùng để kiểm tra giá trị nhập vào
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
        if(isset($_POST["Luu"])){  //Khi nhấn Kiểm duyệt sẽ thực hiện các lệnh
          $idnguoidk = test_input($_POST["idnguoidk"]);
          $tenda = test_input($_POST["tenda"]);
          $noidung = test_input($_POST["noidung"]); 
          $url = test_input($_POST["url"]);
          $ngaybatdau = test_input($_POST["start"]);
          $ngayketthuc = test_input($_POST["end"]); 

          $result = oci_parse($conn,"UPDATE PROFILE_PROJECTS SET USER_ID = '$idnguoidk', NAME= '$tenda', DESCRIPTION='noidung', URL ='url', DATE_START = '$ngaybatdau', DATE_END = '$ngayketthuc', UPDATED_AT = sysdate WHERE ID = '$idda'"); //Cập nhật dữ liệu tương ứng vào database
          oci_execute($result);
          echo "<p align = 'center'>Cập nhật thành công!!!!</p>";
        }
      oci_close($conn);
 ?>

        <form name="form1" method="post" action=""  enctype="multipart/form-data">
        <table align="center">
        <tr>
            <td colspan="2"><h2 style="text-align: center; font-family: Arial">Sửa đổi dự án</h2></td>
        </tr>
        <tr>
            <td>ID người đăng ký:</td>
            <td><label>
              <input type="text" name="idnguoidk" id="idnguoidk" style="width: 300px" value="<?php if(isset($_POST["idnguoidk"])) echo $_POST["idnguoidk"]; else echo $idnguoidk; ?>">
            </label></td>
        </tr>
        <tr>
        <td>Tên đề án: </td>
        <td><label>
            <input type="text" name="tenda" id="tenda" style="width: 300px" value="<?php if(isset($_POST["tenda"])) echo $_POST["tenda"]; else echo $tenda; ?>">
        </label></td>
    </tr>
    <tr>
        <td>Nội dung: </td>
        <td><label>
            <textarea type="text" name="noidung" id="noidung" style="width: 300px" value="<?php if(isset($_POST["noidung"])) echo $_POST["noidung"]; else echo $noidung; ?>"><?php echo $noidung; ?></textarea>
        </label></td>
    </tr> 
    <tr>
        <td>URL: </td>
        <td><label>
            <input type="text" name="url" id="url" style="width: 300px" value="<?php if(isset($_POST["url"])) echo $_POST["url"]; else echo $url; ?>">
        </label></td>
    </tr>
    <tr>
        <td>Ngày bắt đầu: </td>
        <td><label>
            <input type="text" name="start" id="start" style="width: 300px" value="<?php if(isset($_POST["start"])) echo $_POST["start"]; else echo $ngaybatdau; ?>"> (VD: 11-MAY-19 02.22.11.000000000 PM)
        </label></td>
    </tr>
    <tr>
        <td>Ngày kết thúc: </td>
        <td><label>
            <input type="text" name="end" id="end" style="width: 300px" value="<?php if(isset($_POST["end"])) echo $_POST["end"]; else echo $ngayketthuc; ?>"> (VD: 11-MAY-19 02.22.11.000000000 PM)
        </label></td>
    </tr>
    <br>
    <tr>
        <td colspan="2" align="center"><label>
            <input type="submit" name="Luu" value="Lưu">
        </label></td>
    </tr>
    <tr>
        <td colspan="2"><a href="quanlyduan.php?page=1">Quay về</a></td>
    </tr>
    </table>
    </form>
<?php } ?>
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