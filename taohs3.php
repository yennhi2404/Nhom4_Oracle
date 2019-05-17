<?php
  include "dbconnect.php";
  session_start();
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
            <h1 class="text-white font-weight-bold">Đăng kí việc làm</h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Trang chủ</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Đăng kí việc làm</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">
        <div>
          <h3 style="color:red">KỸ NĂNG</h3>
          <form method="post">
            <table>
            <tr><td><label>Kỹ năng:</label></td><td><select name="skills"><option value="COMMUNICATION">Communication</option><option value="Adobe Photoshop">Adobe Photoshop</option><option value="Adobe Illustrator">Adobe Illustrator</option ><option value="Sales">Sales</option><option value="MS Excel">Excel</option><option value="English Fluency">English Fluency</option><option value="CSS">CSS</option><option value="HTML">HTML</option><option value="Java">Java</option><option value="MS Office">Ofice</option><option value="WordPress">Wordpress</option><option value="PHP">PHP</option><option value="Marketing">Marketing</option><option value="MySQL">MySQL</option></select></td></tr>
            <tr><td><label>Cấp bậc:</label></td><td><select name="level"><option value="Beginner">Beginner</option><option value="Intermediate">Intermediate</option><option value="Expert">Expert</option></select></td></tr>
            <tr><td></td><td><input style="color:green" type="submit" value="Lưu" name="saveskill"/></td><td></td></tr>
          </table>
          </form>
       <p id="kq"> <?php
   
    if(isset($_POST['saveskill'])){
              $skill=$_POST['skills'];
              $level=$_POST['level'];
              //Lay id user
               $email=$_COOKIE['email'];
               $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
               $kqq=oci_parse($conn,$sel);
               oci_execute($kqq);
               $idus=0;
               while($row=oci_fetch_row($kqq)){
                         $idus=$row[0];
                }
              //Lay id skill
              $id_skill=0;
              if($skill="COMMUNICATION"){
                 $id_skill=4;
              }else if($skill="Adobe Photoshop"){
                 $id_skill=2;
              }else if($skill="Adobe Illustrator"){
                 $id_skill=1;
              }else if($skill="Sales"){
                 $id_skill=17;
              }else if($skill="MS Excel"){
                $id_skill=13;
              }else if($skill="English Fluency"){
                $id_skill=7;
              }else if($skill="CSS"){
                $id_skill=6;
              }else if($skill="HTML"){
                $id_skill=8;
              }else if($skill="Java"){
                $id_skill=9;
              }else if($skill="MS Office"){
                $id_skill=14;
              }else if($skill="WordPress"){
                $id_skill=19;
              }else if($skill="PHP"){
                $id_skill=16;
              }else if($skill="Marketing"){
                $id_skill=12;
              }else if($skill="MySQL"){
                $id_skill=15;
              }
              //Lay id_level
              $id_level=0;
              if($level="Beginner"){
                $id_level=1;
              }else if($level="Intermediate"){
                $id_level=2;
              }else{
                $id_level=3;
              }
              //Insert
              $query="INSERT INTO PROFILE_SKILLS(USER_ID,JOB_SKILL_ID,JOB_EXPERIENCE_ID, CREATED_AT) VALUES($idus,$id_skill,$id_level,sysdate)";
              $run=oci_parse($conn,$query);
              if(oci_execute($run)){
                echo "Lưu thành công!";
              }
              oci_close($conn);

        }
    ?></p>
        </div>
      </div>
  <hr/>
      <div class="container">
        <div>
          <h3 style="color:red"> KỸ NĂNG KHÁC </h3>
          <form method="post">
            <table>
            <tr><td><label>Kỹ năng:</label></td><td><input type="text" name="another_skill"/></td></tr>
            <tr><td><label>Cấp bậc:</label></td><td><select name="level"><option value="Beginner">Beginner</option><option value="Intermediate">Intermediate</option><option value="Expert">Expert</option></select></td></tr>
            <tr><td></td><td><input style="color:green" type="submit" value="Lưu" name="Save"/></td><td></td></tr>
          </table>
          </form>
          <p><?php if(isset($_POST['Save'])){
                    $another_skill=$_POST['another_skill'];
                    $level = $_POST['level'];
                    //Lay id user
               $email=$_COOKIE['email'];
               $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
               $kqq=oci_parse($conn,$sel);
               oci_execute($kqq);
               $idus=0;
               while($row=oci_fetch_row($kqq)){
                         $idus=$row[0];
                }
                //Lay id level
                $id_level=0;
              if($level="Beginner"){
                $id_level=1;
              }else if($level="Intermediate"){
                $id_level=2;
              }else{
                $id_level=3;
              }
              //Kiem tra skill
              $query="SELECT JOB_SKILL_ID FROM JOB_SKILLS WHERE JOB_SKILL='$another_skill' ";
              $run=oci_parse($conn, $query);
              oci_execute($run);
              $id_another=0;
              while($row=oci_fetch_row($run)){
                $id_another=$row[0];
              }
               $count=0;
               $que="";
              if($id_another==0){
                 
                  $find="SELECT MAX(JOB_SKILL_ID) FROM JOB_SKILLS";
                  $kq=oci_parse($conn,$find);
                  oci_execute($kq);
                  while($row=oci_fetch_row($kq)){
                    $count=$row[0]+1;
                  }

                 $ins="INSERT INTO JOB_SKILLS(JOB_SKILL_ID,JOB_SKILL,CREATED_AT) VALUES(:count,:another_skill,sysdate)";
                  $compile=oci_parse($conn,$ins);
                  oci_bind_by_name($compile, ':another_skill', $another_skill);
                  oci_bind_by_name($compile, ':count', $count);
                  oci_execute($compile);
                    //Insert Profile;
                  $que="INSERT INTO PROFILE_SKILLS(USER_ID,JOB_SKILL_ID,JOB_EXPERIENCE_ID,CREATED_AT) VALUES($idus,$count,$id_level,sysdate)";
                  
              }else{
              //Insert Profile;

              $que="INSERT INTO PROFILE_SKILLS(USER_ID,JOB_SKILL_ID,JOB_EXPERIENCE_ID,CREATED_AT) VALUES($idus,$id_another,$id_level,sysdate)";
            }
              $runn=oci_parse($conn,$que);
              if(oci_execute($runn)){
                echo "Lưu thành công!";
              }
          }   ?> </p>
        </div>
      </div>
      <hr/>
      <div class="container">
        <div>
          <h3 style="color:red">MỤC TIÊU NGHỀ NGHIỆP</h3>
          <form method="post">
            <table>
             <tr><td><label>Công việc mong muốn:</label></td><td><input type="text" name="position" required/></td></tr>
             <tr><td><label>Mức lương gần nhất:</label></td><td><input type="text" name="salarylt" required /></td></tr>
             <tr><td><label>Mức lương mong đợi:</label></td><td><input type="text" name="salaryex" required /></td></tr>
            
             <tr><td></td><td></td></tr>
             <tr><td></td><td><input style="color:green" type="submit" value="Lưu" name="SaveGoal"/></td><td></td></tr>
            </table>
          </form>
          <p><?php if(isset($_POST['SaveGoal'])){
                      $position=$_POST['position'];
                      $salarylt=$_POST['salarylt'];
                      $salaryex=$_POST['salaryex'];
                     
                      //Lay id user
                      $email=$_COOKIE['email'];
                      $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
                      $kqq=oci_parse($conn,$sel);
                      oci_execute($kqq);
                      $idus=0;
                      while($row=oci_fetch_row($kqq)){
                            $idus=$row[0];
                      }
                      //update
                      $ins="UPDATE USERS SET CURRENT_SALARY='$salarylt',EXPECTED_SALARY='$salaryex',EXPECTED_CAREER='$position', UPDATED_AT = sysdate WHERE ID='$idus' ";
                      $compile=oci_parse($conn,$ins);
                      if(oci_execute($compile)){
                        echo "Lưu thành công!";
                      }

          }   ?></p>
          <div ><a  style="color:red" href='cv.php' class="btn btn-block ">Hoàn tất</a></div>
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