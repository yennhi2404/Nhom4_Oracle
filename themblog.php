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
?> 
    <section class="site-section">
      <div class="container">
        
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
    <table align="center">
    <tr>
        <td colspan="2"><h2 style="text-align: center; font-family: Arial">Thêm blog mới</h2></td>
    </tr>    
    <tr>
        <td>Tiêu đề: </td>
        <td><label>
            <input type="text" name="tieude" id="tieude" style="width: 300px" value="<?php if(isset($_POST["tieude"])) echo $_POST["tieude"]; else echo ''; ?>">
        </label></td>
    </tr>
    <tr>
        <td>Nội dung: </td>
        <td><label>
            <textarea type="text" name="noidung" id="noidung" style="width: 300px" value="<?php if(isset($_POST["noidung"])) echo $_POST["noidung"]; else echo ''; ?>"></textarea>
        </label></td>
    </tr>
    <tr>
        <td>Hình ảnh: </td>
        <td><label>
            <input type="file" name="hinhanh" size="40"/>
        </label></td>
    </tr>
    <tr>
        <td>ID tác giả: </td>
        <td><label>
            <input type="text" name="idtacgia" id="idtacgia" value="<?php if(isset($_POST["idtacgia"])) echo $_POST["idtacgia"]; else echo ''; ?>">
        </label></td>
    </tr>
    <tr>
        <td>Hạng mục: </td>
        <td><label>
            <input type="text" name="hangmuc" id="hangmuc" value="<?php if(isset($_POST["hangmuc"])) echo $_POST["hangmuc"]; else echo '';?>">
        </label></td>
    </tr>
    <tr>
        <td>Hình ảnh phụ: </td>
        <td><label>
            <input type="file" name="hinhphu" size="40"/>
        </label></td>
    </tr>
    <br>
    <tr>
        <td colspan="2" align="center"><i> (Hình ảnh hợp lệ chỉ dưới dạng JPG, JPEG, PNG và GIF) </i></td>
    </tr>
    <br>
    <tr>
        <td colspan="2" align="center"><label>
            <input type="submit" name="Luu" value="Lưu">
        </label></td>
    </tr>
    <tr>
        <td colspan="2"><a href="quanlyblog.php?page=1">Quay về</a></td>
    </tr>
</table>
</form>
<?php
        function getExtension($str) { // Hàm này đọc phần mở rộng của file. Nó được dùng để kiểm tra nếu file này có phải là file hình hay không 
            $i = strrpos($str,".");
            $l = strlen($str) - $i;
            $ext = substr($str,$i+1,$l);
            return $ext;
        }
        if(isset($_POST["Luu"])) { //Khi nhấn Lưu sẽ thực hiện các câu lệnh            
            $tieude = $_POST["tieude"];
            $hinhbia = $_FILES["hinhanh"]["name"];
            $noidung = $_POST["noidung"];
            $idtacgia = $_POST["idtacgia"];
            $hangmuc=$_POST["hangmuc"];
            $hinhanhphu = $_FILES["hinhphu"]["name"];

            $stringhinh = $hinhbia.",".$hinhanhphu; // Tạo một tên biến để lưu tất cả ảnh phụ

            if($tieude==''||$noidung==''||$idtacgia==''||$hangmuc==''){ //Kiểm tra rỗng nếu không nhập (hoặc thiếu)
                echo "<p align='center'>Vui lòng nhập đủ thông tin!</p>";
                exit;
            }
            
            $uploadOk = "";
            if ($hinhbia){ 
                //Lấy phần mở rộng của file
                $extension = getExtension($hinhbia);
                $extension = strtolower($extension);
                // Nếu nó không phải là file hình thì sẽ thông báo lỗi
                if (($extension != "jpg") || ($extension != "jpeg") || ($extension !="png") || ($extension != "gif")){
                    $uploadOk = 0;
                }
            }
            if ($hinhanhphu){
                //Lấy phần mở rộng của file
                $extensionsmall1 = getExtension($hinhanhphu);
                $extensionsmall1 = strtolower($extensionsmall1);
                // Nếu nó không phải là file hình thì sẽ thông báo lỗi
                if (($extensionsmall1 != "jpg") || ($extensionsmall1 != "jpeg") || ($extensionsmall1 !="png") || ($extensionsmall1 != "gif")){
                    $uploadOk = 0;
                }
            }
            
            if($_FILES["hinhanh"]["error"]>0 || $_FILES["hinhphu"]["error"]>0){
                echo "<p align='center'>Error: Vui lòng chọn đầy đủ hình ảnh"."<br>".$_FILES["hinhanh"]["error"]."<br>".$_FILES["hinhphu"]["error"]."</p>";
                $uploadOk = 0;
                exit;
            }
            // Kiểm tra $uploadOk bằng 0 
            if ($uploadOk == 0){
                $imagePath = "images/".$_FILES["hinhanh"]["name"];
                move_uploaded_file($_FILES["hinhanh"]["tmp_name"],$imagePath);
                $SmallimagePath1 = "images/".$_FILES["hinhphu"]["name"];
                move_uploaded_file($_FILES["hinhphu"]["tmp_name"],$SmallimagePath1);
            } 
            $result=oci_parse($conn,"INSERT INTO CMS_CONTENT(ID,PAGE_TITLE,PAGE_CONTENT,CREATED_AT,UPDATED_AT,IMAGES, POST_BY_AD_ID, CATEGORY) VALUES ('','$tieude','$noidung',sysdate,'','$stringhinh','$idtacgia','$hangmuc')"); //Thêm dữ liệu tương ứng vào database 

            if(!oci_execute($result)) //Kiểm tra và xuất thông báo
                echo "<br><h3 align='center' style='color:red'>Thêm blog mới thất bại!</h3>".oci_error($result);
            else echo "<h3 align='center' style='color:red'>Thêm blog mới thành công!</h3>";                
            // else echo mysqli_error($conn);
        }}
      oci_close($conn);
 ?>

</div>

</section>
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