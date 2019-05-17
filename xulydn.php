
<?php
    session_start();
    include "dbconnect.php";

       $email=$_POST['txtmail'];
       $pass=$_POST['txtpass'];
       $pass=md5($pass);
    $query='SELECT NAME FROM USERS WHERE EMAIL=:email and PASSWORD=:pass and STATUS = 1';
    $compiled = oci_parse($conn, $query);
    oci_bind_by_name($compiled, ':email', $email);
    oci_bind_by_name($compiled, ':pass', $pass);
     $value="";
     oci_execute($compiled);
     while($row=oci_fetch_row($compiled)){
            $value=$row[0];
          }
    if ($value!=''){
        $name = 'is_login';
        $name_email = 'email';
        $expire = time()+3600;
        $path = '/';
        setcookie($name, $value,$expire ,$path);
        setcookie($name_email, $email,$expire ,$path);
        Header( "Location: http://localhost/jobboard/index.php" );
        $_SESSION['NAME'] = $row[0];
        $_SESSION['EMAIL'] = $email;
    }
    else{
        echo "Email hoặc mật khẩu chưa đúng!. <a href='login.php'>Thử lại</a>";
    }
?>