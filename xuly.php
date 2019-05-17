<?php
    
    include "dbconnect.php";
    
    $email=$_POST['txtEmail'];
    $pass=$_POST['txtMK'];
    $repass=$_POST['txtreMK'];
    $lastname=$_POST['txtLaName'];
    $firstname=$_POST['txtFiName'];
    
    if($pass!=$repass){
        echo('Bạn nhập sai mật khẩu!Vui lòng nhập lại');
        exit;
    }
    
    $pass=md5($pass);
    $result=oci_parse($conn,'Select EMAIL from USERS');
    oci_execute($result);
    while($row = oci_fetch_row($result)){
        if($row[0]==$email){
            echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='login.php'>Thử lại</a>";
            exit;
        }
    }
    $query='INSERT INTO USERS(NAME,EMAIL,PASSWORD, FULL_NAME, ID_LOAI_USER)'. 'VALUES(:firstname,:email,:pass,:lastname, 2)';
    $compiled = oci_parse($conn, $query);
     oci_bind_by_name($compiled, ':firstname', $firstname);
    oci_bind_by_name($compiled, ':email', $email);
    oci_bind_by_name($compiled, ':pass', $pass);
    oci_bind_by_name($compiled, ':lastname', $lastname);
    
    if (oci_execute($compiled)){
        echo "Đăng kí thành công!. <a href='login.php'>Đăng nhập </a>";
        
    }
    else{
        echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='login.php'>Thử lại</a>";
    }
      

?>
