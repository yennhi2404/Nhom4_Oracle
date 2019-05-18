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
          <div class="col-md-12">
            <div class="custom-breadcrumbs mb-0">
              <?php 
                $ma_blog = $_GET["ma"];
                $orc="SELECT c.PAGE_TITLE, c.PAGE_CONTENT, TO_CHAR(c.CREATED_AT,'DD-MM-YYYY'), c.IMAGES, a.FULL_NAME FROM CMS_CONTENT c, USERS a WHERE c.POST_BY_AD_ID = a.ID AND c.ID = $ma_blog";
                $run=oci_parse($conn,$orc);
                oci_execute($run);
                 
                while ($row=oci_fetch_array($run)){
                  $gallery = explode(',',$row[3],4); 
                  echo '<span class="slash">Đăng bởi '.$row[4].'
                            <span class="mx-2 slash">&bullet;</span>
                            <span class="text-white"><strong>'.$row[2].'</strong></span>
                          </div>
                          <h1 class="text-white">'.$row[0]->load().'</h1>
                        </div>
                      </div>
                    </div>
                  </section>';
                  echo '<section class="site-section" id="next-section">
                          <div class="container">
                            <div class="row">
                              <div class="col-lg-8 blog-content">
                                <p class="lead">'.$row[1]->load().'</p>';
                                 for($i=0;$i<=sizeof($row[3]);$i++){ 
                                    echo '<p><img src="images/'.$gallery[$i].'" alt="Free Website Template by Free-Template.co" class="img-fluid rounded" width="500px" height="50px"></p>';

                                  } 
                                }
              ?>
            <div class="pt-5">
              <p>Hạng mục:  
                <?php 
                  $ma = $_GET["ma"];
                 $orc="SELECT CATEGORY FROM CMS_CONTENT WHERE ID = $ma";
                  $run=oci_parse($conn,$orc);
                  oci_execute($run);
                  while($row = oci_fetch_array($run)){
                    echo '<span>'.$row[0].'</span>';
                  }
                ?>
                </p>
            </div>


            <div class="pt-5">
              <h3 class="mb-5">
                <?php 
                 $ma = $_GET['ma'];
                 $orc="SELECT COMMENTS_BLOG.ID,FULL_NAME,COMMENTS,TO_CHAR(COMMENTS_BLOG.CREATED_AT,'DD-MM-YYYY'), 
                 TO_CHAR(COMMENTS_BLOG.CREATED_AT, 'HH24:MI:SS') FROM COMMENTS_BLOG,USERS WHERE COMMENTS_BLOG.IDUSER = USERS.ID AND COMMENTS_BLOG.IDBLOG = $ma";
                  $run=oci_parse($conn,$orc);
                  oci_execute($run);
                  while($row = oci_fetch_array($run)){}
                  echo oci_num_rows($run);   
                ?> Bình luận</h3>

              <ul class="comment-list">
                <?php 
                    $ma = $_GET['ma'];
                    $orc="SELECT COMMENTS_BLOG.ID,FULL_NAME,COMMENTS,TO_CHAR(COMMENTS_BLOG.CREATED_AT,'DD-MM-YYYY'), 
                          TO_CHAR(COMMENTS_BLOG.CREATED_AT, 'HH24:MI:SS'),IMAGE FROM COMMENTS_BLOG,USERS WHERE COMMENTS_BLOG.IDUSER = USERS.ID AND COMMENTS_BLOG.IDBLOG = $ma";
                    $run=oci_parse($conn,$orc);
                    oci_execute($run);
                    while($row = oci_fetch_array($run)){
                        $nhanxet = $row[2];
                        $tenkh = $row[1];
                        $idnhanxet = $row[0];
                        $ngay = $row[3];
                        $gio = $row[4];
                        echo '<li class="comment">
                              <div class="vcard bio">
                                <img src="images/'.$row[5].'" alt="Image placeholder">
                              </div>
                              <div class="comment-body">
                                <h3>'.$tenkh.'</h3>
                                <div class="meta">'.$ngay.' lúc '.$gio.'</div>
                                <p>'.$nhanxet.'</p>
                              </div>
                            </li>';
                    }                          
                ?>  
                <!-- <li class="comment">
                  <div class="vcard bio">
                    <img src="images/person_2.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>Jacob Smith</h3>
                    <div class="meta">9 tháng 1, 2018 lúc 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply">Phản hồi</a></p>
                  </div>
                </li>

                <li class="comment">
                  <div class="vcard bio">
                    <img src="images/person_3.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>Chris Meyer</h3>
                    <div class="meta">January 9, 2018 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply">Reply</a></p>
                  </div>

                  <ul class="children">
                    <li class="comment">
                      <div class="vcard bio">
                        <img src="images/person_5.jpg" alt="Image placeholder">
                      </div>
                      <div class="comment-body">
                        <h3>Chintan Patel</h3>
                        <div class="meta">January 9, 2018 at 2:21pm</div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                        <p><a href="#" class="reply">Reply</a></p>
                      </div>


                      <ul class="children">
                        <li class="comment">
                          <div class="vcard bio">
                            <img src="images/person_1.jpg" alt="Image placeholder">
                          </div>
                          <div class="comment-body">
                            <h3>Jean Doe</h3>
                            <div class="meta">January 9, 2018 at 2:21pm</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                            <p><a href="#" class="reply">Reply</a></p>
                          </div>

                            <ul class="children">
                              <li class="comment">
                                <div class="vcard bio">
                                  <img src="images/person_4.jpg" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                  <h3>Ben Afflick</h3>
                                  <div class="meta">January 9, 2018 at 2:21pm</div>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                  <p><a href="#" class="reply">Reply</a></p>
                                </div>
                              </li>
                            </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>

                <li class="comment">
                  <div class="vcard bio">
                    <img src="images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>Jean Doe</h3>
                    <div class="meta">January 9, 2018 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply">Reply</a></p>
                  </div>
                </li> -->
              </ul>
              <!-- END comment-list -->
              
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Nhận xét</h3>
                <?php $ma = $_GET["ma"];?>
                <form action="blog-single.php?ma='.$ma.'" class="" method="GET" id="comment_form">
                  <input type="hidden" name="ma" value="<?php echo $ma ?>">
                  <div class="form-group">
                    <label for="name">Tên *</label>
                    <input type="hidden" name="comment_id" id="commentId" />
                    <input type="text" class="form-control" id="fname" name="fname" value="<?php if(isset($_GET["fname"])) echo $_GET["fname"]; else echo ''; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($_GET["email"])) echo $_GET["email"]; else echo ''; ?>">
                  </div>

                  <div class="form-group">
                    <label for="message">Tin nhắn</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control" value="<?php if(isset($_GET["message"])) echo $_GET["message"]; else echo ''; ?>"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Đăng" class="btn btn-primary btn-md" name="Submit" id="Submit">
                  </div>
                </form>
                <?php
                    $hoten = '';
                    $email = '';
                    $message = '';
                    $error = '';
                    $ma = $_GET["ma"];


                          if(empty($_GET["fname"])){
                         $error = '<p class="text-danger">Name is required</p>';
                         echo $error;
                       } else $hoten=$_GET['fname'];

                        if(empty($_GET["email"])){
                         $error = '<p class="text-danger">Email is required</p>';
                         echo $error;
                        } else $email=$_GET['email'];

                        if(empty($_GET["message"])){
                         $error = '<p class="text-danger">Message is required</p>';
                         echo $error;
                        } else $message=$_GET['message'];

                       if(isset($_GET['Submit']) && $error==''){
                        $sql = "SELECT ID FROM USERS WHERE FULL_NAME='$hoten'";
                        $run_sql=oci_parse($conn,$sql);
                        oci_execute($run_sql);
                        while($row=oci_fetch_array($run_sql)){
                            $idkh = $row[0];
                            $query = "INSERT INTO COMMENTS_BLOG VALUES ('','$message',$idkh,$ma,'Chưa duyệt',sysdate)";
                              $run=oci_parse($conn,$query);
                              oci_execute($run);
                        }
                    }
                    ?> 
                
              </div>
            </div>

          </div>
          <div class="col-lg-4 sidebar pl-lg-5">
            <div class="sidebar-box">
              
             <form action="hangmuc.php" class="search-form" method="GET">
                <div class="form-group">
                  <span class="icon fa fa-search"></span>
                  <input type="text" class="form-control form-control-lg" placeholder="Nhập từ khóa và enter" name="loai">
                  <input type="hidden" name="page" value="1" />
                </div>
              </form>
            </div>
            <div class="sidebar-box">
              <?php 
                $ma_blog = $_GET["ma"];
                $orc="SELECT a.DESCRIPTION,a.IMAGE FROM CMS_CONTENT c, USERS a WHERE c.POST_BY_AD_ID = a.ID AND c.ID = $ma_blog";
                $run=oci_parse($conn,$orc);
                oci_execute($run);
                 
                while ($row=oci_fetch_array($run)){
                  echo '<img src="images/'.$row[1].'" alt="Image placeholder" class="img-fluid mb-4 w-50 rounded-circle">
                        <h3>Tác giả</h3>
                        <p>'.$row[0].'</p>';
                }
              ?>
            </div>

            <div class="sidebar-box">
              <div class="categories">
                <h3>Hạng mục</h3>
                <li><a href="hangmuc.php?loai=photoshop&page=1">Photoshop </a></li>
                <li><a href="hangmuc.php?loai=html&page=1">HTML </a></li>
                <li><a href="hangmuc.php?loai=css&page=1">CSS </a></li>
                <li><a href="hangmuc.php?loai=php&page=1">PHP </a></li>
                <li><a href="hangmuc.php?loai=jquery&page=1">Jquery </a></li>
              </div>
            </div>
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
    <script src="js/quill.min.js"></script>
    
    
    <script src="js/bootstrap-select.min.js"></script>
    
    <script src="js/custom.js"></script>
  </body>
</html>