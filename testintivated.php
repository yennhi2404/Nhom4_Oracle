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
     $base_url='http://localhost/jobboard/jobboard/';
    $pass=md5($pass);
    $result=oci_parse($conn,'Select EMAIL from USERS');
    oci_execute($result);
    while($row = oci_fetch_row($result)){
        if($row[0]==$email){
            echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='login.php'>Thử lại</a>";
            exit;
        }
    }
    $status=0;
     $activation=md5($email.time()); // mã hóa email và thời gian
    $query='INSERT INTO USERS(NAME,EMAIL,PASSWORD,ACTIVATION,STATUS)'. 'VALUES(:firstname,:email,:pass,:activation,:status
    )';
    $compiled = oci_parse($conn, $query);
     oci_bind_by_name($compiled, ':firstname', $firstname);
    oci_bind_by_name($compiled, ':email', $email);
    oci_bind_by_name($compiled, ':pass', $pass);
    oci_bind_by_name($compiled, ':activation', $activation);
    oci_bind_by_name($compiled, ':status', $status);
    oci_execute($compiled);

    include 'send_mail.php';
         $to=$email;
         $subject="Email verification";
         $body='Hi, <br/> <br/> We need to make sure you are human. Please verify your email and get started using your Website account. <br/> <br/> <a href="'.$base_url.'activation?code='.$activation.'">'.$base_url.'activation/'.$activation.'</a>';
         //Gửi mail
         Send_Mail($to,$subject,$body);
         $msg= "Registration successful, please activate email.";
     
    
   /* if (oci_execute($compiled)){
        echo "Đăng kí thành công!. <a href='login.php'>Đăng nhập </a>";
        
    }
    else{
        echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='login.php'>Thử lại</a>";
    }*/
      

?>
         
          