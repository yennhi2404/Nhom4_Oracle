<?php
$dest_file="";
include "dbconnect.php";
session_start();
if (isset( $_POST['upload'] ) ) {
	
	    $image_name=time().'.'.'pdf';
		$source_file = $_FILES['file']['tmp_name'];
		$dest_file = "testupload/".$image_name;

		if (file_exists($dest_file)) {
			echo "The file name already exists!!";
		}
		else{
			
			move_uploaded_file( $source_file, $dest_file )
			or die ("Error!!");
			
			$email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
           $kqq=oci_parse($conn,$sel);
           oci_execute($kqq);
           $idus=0;
            while($row=oci_fetch_row($kqq)){
               $idus=$row[0];
            }
           
           $query="INSERT INTO PROFILE_CVS(ID,USER_ID,CV_FILE) VALUES($idus,$idus,'$dest_file')";
           $run=oci_parse($conn,$query);
            if(oci_execute($run)){
            	 echo '<a href="noppdf.php?path='.$dest_file.'">Gửi CV</a>';
            }else{
            	echo "Error";
            }        
		}
} 
?>