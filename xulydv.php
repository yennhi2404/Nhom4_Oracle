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
            <h1 class="text-white font-weight-bold">Đăng việc</h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Trang chủ</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Đăng việc</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">
        
        <div class="row">
         
          <?php
define ("MAX_SIZE","100");
 
// hàm này đọc phần mở rộng của file. Nó được dùng để kiểm tra nếu
// file này có phải là file hình hay không .
function getExtension($str) {
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}

$errors=0;
$image=$email=$country=$jobtt=$joblocation=$region=$type=$description=$cmpname=$jobds=$website=$salary=$img_name="";
if((isset($_POST['submit']) && isset($_COOKIE['is_login'])=="")){
  //Header( "Location: http://localhost/jobboard/index.php" );
  echo "<script type='text/javascript'> alert('Vui lòng đăng nhập để đăng việc!'); </script>";
  //echo '<a href="dangxuat.php" onClick=\'javascript: return c("Đăng xuất")\'></a>';
  echo '<script>
  window.location.replace("http://localhost/jobboard/login.php");
  </script>';
}
if(isset($_POST['submit']) && isset($_COOKIE['is_login']))
{
$image=$_FILES['image']['name'];
$email=$_POST['email'];
$country=$_POST['countries'];
$jobtt=$_POST['title'];
$joblocation=$_POST['location'];
$region=$_POST['region'];
$type=$_POST['type'];
$cmpname=$_POST['companyname'];
$jobdc=$_POST['jobdc'];
$website=$_POST['website'];
$salary=$_POST['Salary'];
$comdc = $_POST['comdc'];
$trachnhiem = $_POST['trachnhiem'];
$kinhnghiem = $_POST['kinhnghiem'];

$check = 1;
if($email==''||$country==''||$jobtt==''||$joblocation==''||$region==''||$type==''||$cmpname==''||$website==''||$salary==''){ //Kiểm tra rỗng nếu không nhập (hoặc thiếu)
  echo "<p align='center'>Vui lòng nhập đầy đủ thông tin!</p>";
  $check = 0;
}

$errors=1;
if ($image){
  // Lấy tên gốc của file
  $filename = stripslashes($_FILES['image']['name']);
  //Lấy phần mở rộng của file
  $extension = getExtension($filename);
  $extension = strtolower($extension);
  // Nếu nó không phải là file hình thì sẽ thông báo lỗi
  if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){
    // xuất lỗi ra màn hình
    echo '<h1>Đây không phải là file hình!</h1>';
    $errors=0;
  }else{
    //Lấy dung lượng của file upload
    $size=filesize($_FILES['image']['tmp_name']);
  if ($size > MAX_SIZE*1024){
    echo '<h1>Vượt quá dung lượng cho phép!</h1>';
    $errors=0;
  }}}


// // đặt tên mới cho file hình up lên
// $image_name=time().'.'.$extension;
// // gán thêm cho file này đường dẫn
// $newname="images/".$image_name;
// // kiểm tra xem file hình này đã upload lên trước đó chưa
// $copied = copy($_FILES['image']['tmp_name'], $newname);
// if (!$copied){
//   echo '<h1> File hình này đã tồn tại </h1>';
//   $errors=0;
// }
if ($errors <> 0){
    $imagePath1 = "images/".$_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"],$imagePath1);
  }
 $region_id = 0;
//Lay region id 
$sql="SELECT REGION_ID FROM REGIONS WHERE REGION_NAME='$region'";
$kq=oci_parse($conn, $sql);
oci_execute($kq);
while($row=oci_fetch_row($kq)){
  $region_id=$row[0];
}

$countries_id=0;

//Lay country id
$query="SELECT ID FROM COUNTRIES WHERE COUNTRY='$country'";
$kq=oci_parse($conn, $query);
oci_execute($kq);
while($row=oci_fetch_row($kq)){
	$countries_id=$row[0];
}

//Lay job type id
$type_id=0;
$que="SELECT ID FROM JOB_TYPES WHERE JOB_TYPE='$type'";
$kqq=oci_parse($conn, $que);
oci_execute($kqq);
while($row=oci_fetch_row($kqq)){
	$type_id=$row[0];
}
//Insert vo Company
$company="SELECT ID FROM COMPANIES WHERE NAME='$cmpname'";
$resul=oci_parse($conn,$company);
oci_execute($resul);
$cmp_id=0;
while($row=oci_fetch_row($resul)){
	$cmp_id=$row[0];
}

if($cmp_id==0){
$com="INSERT INTO COMPANIES(NAME,WEBSITE,DESCRIPTION,CREATED_AT) VALUES ('$cmpname','$website','$comdc',sysdate)";
$result=oci_parse($conn,$com);
oci_execute($result);
$company="SELECT ID FROM COMPANIES WHERE NAME='$cmpname'";
$resul=oci_parse($conn,$company);
oci_execute($resul);
while($row=oci_fetch_row($resul)){
	$cmp_id=$row[0];
}
}

//Insert vo JOBS
$ins="INSERT INTO JOBS (NAMEIMG,TITLE,COUNTRY_ID,LOCATION,REGION_ID,JOB_TYPE_ID,HIDE_SALARY,WEBSITE,COMPANY_ID,EMAIL,JOBDESCRIPTION,JOB_RESPONSIBILITY,JOB_EXPERIENCE,CREATED_AT) VALUES('$image','$jobtt','$countries_id','$joblocation','$region_id','$type_id','$salary','$website','$cmp_id','$email','$jobdc','$trachnhiem','$kinhnghiem',sysdate)";
$re=oci_parse($conn,$ins);
if($check <> 0){
  oci_execute($re);
	echo "Đăng việc thành công! <a href='index.php'>Trở lại</a>";
}else echo "<h3 align='center'>Đăng việc thất bại! </h3>".oci_error($re); 
}
?>
          <!-- <div class="col-lg-6 mb-4">
            <div class="block__87154">
              <blockquote>
                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_1.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid"></figure>
                <div>
                  <h3>Elisabeth Smith</h3>
                  <span class="position">Creative Director</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="block__87154">
              <blockquote>
                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam, cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_2.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid"></figure>
                <div>
                  <h3>Chris Peter</h3>
                  <span class="position">Web Designer</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="block__87154">
              <blockquote>
                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_3.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid"></figure>
                <div>
                  <h3>Benjamin Lewis</h3>
                  <span class="position">Creative Director</span>
                </div>
              </div>
            </div>
          </div> -->

          <!-- <div class="col-lg-6 mb-4">
            <div class="block__87154">
              <blockquote>
                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam, cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_4.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid"></figure>
                <div>
                  <h3>Pippa Cooper</h3>
                  <span class="position">Web Designer</span>
                </div>
              </div>
            </div>
          </div> -->

          <!-- <div class="col-lg-12 mb-4">
            <div class="block__87154 bg-primary">
              <blockquote>
                <p class="text-white">&ldquo;Ipsum harum assumenda in eum vel eveniet numquam, cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_4.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid"></figure>
                <div>
                  <h3 class="text-white">Pippa Cooper</h3>
                  <span class="position position-2">Web Designer</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="block__87154">
              <blockquote>
                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_1.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid"></figure>
                <div>
                  <h3>Elisabeth Smith</h3>
                  <span class="position">Creative Director</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="block__87154">
              <blockquote>
                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam, cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_2.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid"></figure>
                <div>
                  <h3>Chris Peter</h3>
                  <span class="position">Web Designer</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="block__87154">
              <blockquote>
                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_3.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid"></figure>
                <div>
                  <h3>Benjamin Lewis</h3>
                  <span class="position">Creative Director</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="block__87154">
              <blockquote>
                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam, cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_4.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid"></figure>
                <div>
                  <h3>Pippa Cooper</h3>
                  <span class="position">Web Designer</span>
                </div>
              </div>
            </div>
          </div> -->

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
/**/