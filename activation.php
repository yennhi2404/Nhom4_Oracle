 <?php
include 'dbconnect.php';
$msg='';
if(!empty($_GET['code']) && isset($_GET['code']))
{
   $code=$_GET['code'];
   $query="SELECT ID FROM USERS WHERE ACTIVATION='$code'";
   $c=oci_parse($conn,$query);
   $msg='kk';
   $dem=0;
   if(oci_execute($c))
   {
      $count=oci_parse($conn,"SELECT ID FROM USERS WHERE activation='$code' and status=0");
      oci_execute($count);

      while($row=oci_fetch_row($count)){
                 $dem++;
      }
     
       
      if($dem == 1)
      {
        $up=oci_parse($conn,"UPDATE USERS SET STATUS=1 WHERE activation='$code'");
        oci_execute($up);
         echo "<script>alert('Your account is activated!Login!')</script>";
         echo "<script>window.location.replace('http://localhost/jobboard/jobboard/login.php')</script>";
      }
      else
      {
         echo "<script>alert('Your account is already active, no need to activate again.Please Login!')</script>";
         echo "<script>window.location.replace('http://localhost/jobboard/jobboard/login.php')</script>";
      }
   }
   else
   {
      $msg ="Wrong activation code.";
   }
   
}
?>
