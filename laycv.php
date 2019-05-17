<?php 
 include "dbconnect.php";
 session_start();
 //Lay id user
        $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
           $kqq=oci_parse($conn,$sel);
           oci_execute($kqq);
           $idus=0;
            while($row=oci_fetch_row($kqq)){
               $idus=$row[0];
            }

              $query="SELECT CV_FILE FROM PROFILE_CVS WHERE ID=$idus";
              $run=oci_parse($conn,$query);
              oci_execute($run);
              $cv="";
            while($row=oci_fetch_row($run)){
               $cv=$row[0];
            }
            echo "<iframe src=\"$cv\" width=\"100%\" style=\"height:100%\"></iframe>";
            echo "<div align='center'>";
            echo '<a href="noppdf.php?path='.$cv.'">Gửi CV</a>';
            echo "</div>";

 ?>