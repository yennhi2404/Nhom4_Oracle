<?php
include "dbconnect.php";
session_start();
?>
<form method="post" action="guiemail.php">
<h3 style="text-align: center;color:red">INFORMATION</h3>
            <table  align="center">
              <tr><td><label>Full Name:</label></td><td><?php 
              $email=$_COOKIE['email'];
        //Lay Full Name
        $query="SELECT FULL_NAME FROM USERS WHERE EMAIL='$email'" ;
        $run=oci_parse($conn, $query);
        if(oci_execute($run)){
          $name="";
           while($row=oci_fetch_row($run)){
                    $name=$row[0];
           }
           echo $name;
        }
        ?></td></tr>
              <tr><td><label>Date of birth:</label></td><td>
                <?php 
              $email=$_COOKIE['email'];
        //Lay Full Name
        $query="SELECT DATE_OF_BIRTH FROM USERS WHERE EMAIL='$email'" ;
        $run=oci_parse($conn, $query);
        if(oci_execute($run)){
          $bd="";
           while($row=oci_fetch_row($run)){
                    $bd=$row[0];
           }
           echo $bd;
        }?>

              </td></tr>
              <tr><td><label>Address:</label></td><td><p>
                <?php 
              $email=$_COOKIE['email'];
        //Lay Address
        $query="SELECT STREET_ADDRESS FROM USERS WHERE EMAIL='$email'" ;
        $run=oci_parse($conn, $query);
        if(oci_execute($run)){
          $ad="";
           while($row=oci_fetch_row($run)){
                    $ad=$row[0];
           }
           echo $ad;
        }?>
              </p></td></tr>
               <tr><td><label>Province/City:</label></td><td><p>
                 <?php 
              $email=$_COOKIE['email'];
        //Lay Full Name
        $query="SELECT  COUNTRY_ID FROM USERS WHERE EMAIL='$email'" ;
        $run=oci_parse($conn, $query);
        if(oci_execute($run)){
          $country_id="";
           while($row=oci_fetch_row($run)){
                    $country_id=$row[0];
           }
         
        $find="SELECT COUNTRY FROM COUNTRIES WHERE ID like :country_id";
        $kq=oci_parse($conn,$find);
        oci_bind_by_name($kq, ":country_id", $country_id);
         $country="";
        if(oci_execute($kq)){
         
           while($row=oci_fetch_row($kq)){
                    $country=$row[0];
           }
              echo $country;          
        }
       } ?>
               </p></td></tr>
                     <tr><td><label>Sex:</label></td><td><p>
                        <?php 
              $email=$_COOKIE['email'];
        //Lay Full Name
        $query="SELECT  GENDER_ID FROM USERS WHERE EMAIL='$email'" ;
        $run=oci_parse($conn, $query);
        if(oci_execute($run)){
          $id=0;
           while($row=oci_fetch_row($run)){
                    $id=$row[0];
           }
            if($id==1){
              echo "Female";
            }else{
              echo "Male";
            }
        
        }?>
                     </p></td></tr>
                     <tr><td><label>Phone:</label></td><td><p> <?php 
              $email=$_COOKIE['email'];
        //Lay Full Name
        $query="SELECT PHONE FROM USERS WHERE EMAIL='$email'" ;
        $run=oci_parse($conn, $query);
        if(oci_execute($run)){
          $phone="";
           while($row=oci_fetch_row($run)){
                    $phone=$row[0];
           }
           echo $phone;
         }?></p></td></tr>
          </table>
        
       <h3 style="text-align:center;color:red">EDUCATION</h3>
         
            <table align="center">
              <tr><td><label>Academic level:</label></td><td><p> <?php $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
        $kqq=oci_parse($conn,$sel);
        oci_execute($kqq);
        $idus=0;
        while($row=oci_fetch_row($kqq)){
          $idus=$row[0];}
          //Lay level
          $query="SELECT ACADEMIC FROM PROFILE_EDUCATIONS WHERE USER_ID=$idus" ;
        $run=oci_parse($conn, $query);
        if(oci_execute($run)){
          $ad="";
           while($row=oci_fetch_row($run)){
                    $ad=$row[0];
           }
           echo $ad;
         }
          ?></p></td></tr>
              <tr><td><label>School Name:</label></td><td><p><?php $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
        $kqq=oci_parse($conn,$sel);
        oci_execute($kqq);
        $idus=0;
        while($row=oci_fetch_row($kqq)){
          $idus=$row[0];}
          //Lay level
          $query="SELECT SCHOOLNAME FROM PROFILE_EDUCATIONS WHERE USER_ID=$idus" ;
        $run=oci_parse($conn, $query);
        if(oci_execute($run)){
          $ad="";
           while($row=oci_fetch_row($run)){
                    $ad=$row[0];
           }
           echo $ad;
         }?></p></td></tr>
              <tr><td><label>Major:</label></td><td><p>
                <?php $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
        $kqq=oci_parse($conn,$sel);
        oci_execute($kqq);
        $idus=0;
        while($row=oci_fetch_row($kqq)){
          $idus=$row[0];}
          //Lay level
          $query="SELECT MAJOR FROM PROFILE_EDUCATIONS WHERE USER_ID=$idus" ;
        $run=oci_parse($conn, $query);
        if(oci_execute($run)){
          $ad="";
           while($row=oci_fetch_row($run)){
                    $ad=$row[0];
           }
           echo $ad;
         }?>
              </p></td></tr>
              <tr><td>Education process:</td><td>
                
                  <p name="job-description">...</p>
               
              </td></tr>
               
            </table>
           
          
       <h3 style="color:red;text-align:center">NGOẠI NGỮ</h3>
      
            <table align="center">
            <tr><td><label>Ngoại ngữ:</label></td><td><p>
              <?php $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
        $kqq=oci_parse($conn,$sel);
        oci_execute($kqq);
        $idus=0;
        while($row=oci_fetch_row($kqq)){
          $idus=$row[0];}
          //Lay level
          $query="SELECT LANGUAGE_ID FROM PROFILE_LANGUAGES WHERE USER_ID=$idus" ;
        $run=oci_parse($conn, $query);
        oci_execute($run);
            $lang="";
            $tmp1="";
            $tmp2="";
           while($row=oci_fetch_row($run)){
                   $ad=$row[0];
                   if($tmp1==""){
                      $tmp1=$ad;
                       $find="SELECT LANG FROM LANGUAGES WHERE ID=$ad";
                    $kq=oci_parse($conn,$find);
                    if(oci_execute($kq)){
                      while($row=oci_fetch_row($kq)){
                         $lang=$row[0];
                         
                      }
                      echo $lang;
                      echo " ";
                   }
                 }
                   if($ad!=$tmp1&&$ad!=$tmp2){
                      $tmp2=$ad;
                       $find="SELECT LANG FROM LANGUAGES WHERE ID=$ad";
                    $kq=oci_parse($conn,$find);
                    if(oci_execute($kq)){
                      while($row=oci_fetch_row($kq)){
                         $lang=$row[0];
                         
                      }
                      echo $lang;
                      echo " ";
                   }
                 }                    
                    } 
         ?>
            </p></td></tr>
          </table>
    
     <h3 style="color:red;text-align:center">KINH NGHIỆM</h3>
          
            <table align="center">
              <tr><td><label>Vị trí:</label></td><td><p>
                <?php $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
        $kqq=oci_parse($conn,$sel);
        oci_execute($kqq);
        $idus=0;
        while($row=oci_fetch_row($kqq)){
          $idus=$row[0];}
          $find="SELECT TITLE FROM PROFILE_EXPERIENCES WHERE USER_ID=$idus";
          $run=oci_parse($conn, $find);
          if(oci_execute($run)){
            while($row=oci_fetch_row($run)){
              $kq=$row[0];
            }
            echo $kq;
          }
          ?>
              </p></td></tr>
              <tr><td><label>Thời gian:</label></td><td><p>
                <?php $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
        $kqq=oci_parse($conn,$sel);
        oci_execute($kqq);
        $idus=0;
        while($row=oci_fetch_row($kqq)){
          $idus=$row[0];}
          $find="SELECT TOTAL_TIME FROM PROFILE_EXPERIENCES WHERE USER_ID=$idus";
          $run=oci_parse($conn, $find);
          if(oci_execute($run)){
            while($row=oci_fetch_row($run)){
              $kq=$row[0];
            }
            echo $kq;
          }
          ?>
              </p></td></tr>
              <tr><td><label>Tỉnh/Thành phố:</label></td><td><p>
                <?php $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
        $kqq=oci_parse($conn,$sel);
        oci_execute($kqq);
        $idus=0;
        while($row=oci_fetch_row($kqq)){
          $idus=$row[0];}
          $find="SELECT CITY FROM PROFILE_EXPERIENCES WHERE USER_ID=$idus";
          $run=oci_parse($conn, $find);
          if(oci_execute($run)){
            while($row=oci_fetch_row($run)){
              $kq=$row[0];
            }
            echo $kq;
          }
          ?>
              </p></td></tr>
              <tr><td>Quốc gia:</td><td><p>
                <?php $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
        $kqq=oci_parse($conn,$sel);
        oci_execute($kqq);
        $idus=0;
        while($row=oci_fetch_row($kqq)){
          $idus=$row[0];}
          $find="SELECT COUNTRY_ID FROM PROFILE_EXPERIENCES WHERE USER_ID=$idus";
          $run=oci_parse($conn, $find);
          $country_id="";
          if(oci_execute($run)){
            while($row=oci_fetch_row($run)){
              $country_id=$row[0];
            }

            $query ="SELECT COUNTRY FROM COUNTRIES WHERE COUNTRY_ID like '$country_id'";
        $kq=oci_parse($conn,$query);
        if(oci_execute($kq)){
           while($row=oci_fetch_row($kq)){
                    $country=$row[0];
           }
              echo $country;         
        }           
          }
          ?>
              </p></tr>
                    <tr><td>Quá trình làm việc:</td><td>
              
                  <p name="Mô tả"></p>
               
              </td></tr>
             
            </table>
             <h3 style="color:red;text-align: center">KỸ NĂNG</h3>
          
            <table align="center">
            <tr><td><label>Kỹ năng:</label></td><td><p><?php  
              $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
        $kqq=oci_parse($conn,$sel);
        oci_execute($kqq);
        $idus=0;
        while($row=oci_fetch_row($kqq)){
          $idus=$row[0];}
          $find="SELECT JOB_SKILL_ID FROM PROFILE_SKILLS WHERE USER_ID=$idus";
          $run=oci_parse($conn, $find);
          oci_execute($run);
           $lang="";
            $tmp1="";
            $tmp2="";
           while($row=oci_fetch_row($run)){
                   $ad=$row[0];
                   if($tmp1==""){
                      $tmp1=$ad;
                       $find="SELECT JOB_SKILL FROM JOB_SKILLS WHERE JOB_SKILL_ID=$ad";
                    $kq=oci_parse($conn,$find);
                    if(oci_execute($kq)){
                      while($row=oci_fetch_row($kq)){
                         $lang=$row[0];
                         
                      }
                      echo $lang;
                      echo " ";
                   }
                 }
                   if($ad!=$tmp1&&$ad!=$tmp2){
                      $tmp2=$ad;
                       $find="SELECT JOB_SKILL FROM JOB_SKILLS WHERE JOB_SKILL_ID=$ad";
                    $kq=oci_parse($conn,$find);
                    if(oci_execute($kq)){
                      while($row=oci_fetch_row($kq)){
                         $lang=$row[0];
                         
                      }
                      echo $lang;
                      echo " ";
                   }
                 }
               }

          ?>  </p></td></tr>
            <tr><td><label>Cấp bậc:</label></td><td><p>
              <?php  
              $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
        $kqq=oci_parse($conn,$sel);
        oci_execute($kqq);
        $idus=0;
        while($row=oci_fetch_row($kqq)){
          $idus=$row[0];}
          $find="SELECT JOB_EXPERIENCE_ID FROM PROFILE_SKILLS WHERE USER_ID=$idus";
          $run=oci_parse($conn, $find);
          oci_execute($run);
          $tmp1=0;
          $tmp2=0;
          $lang="";
           while($row=oci_fetch_row($run)){
                   $ad=$row[0];
                   if($tmp1==0){
                      $tmp1=$ad;
                         if($ad==1){
                                  $lang="Beginner";
                         }else if($ad==2){
                                    $lang="Intermediate";
                         }else if($ad==3){
                                  $lang="Experted";
                         }
                      
                      echo $lang;
                      echo " ";
                    }
                                 
                   if($ad!=$tmp1&&$ad!=$tmp2){
                      $tmp2=$ad;

                         if($ad==1){
                                  $lang="Beginner";
                         }else if($ad==2){
                                    $lang="Intermediate";
                         }else if($ad==3){
                                  $lang="Experted";
                      }
                      echo $lang;
                      echo " ";
                   }
                 }

          ?>
            </p></td></tr>
            
          </table>
         <h3 style="color:red;text-align:center">MỤC TIÊU NGHỀ NGHIỆP</h3>
            <table align="center">
             <tr><td><label>Công việc mong muốn:</label></td><td><p><?php 
                $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
        $kqq=oci_parse($conn,$sel);
        oci_execute($kqq);
        $idus=0;
        while($row=oci_fetch_row($kqq)){
          $idus=$row[0];}
          $find="SELECT EXPECTED_CAREER FROM USERS WHERE ID=$idus";
          $run=oci_parse($conn, $find);
          oci_execute($run);
          $value="";
          while($row=oci_fetch_row($run)){
                 $value=$row[0];
          }
          echo $value;
        
             ?></p></td></tr>
             <tr><td><label>Mức lương gần nhất:</label></td><td><p>
              <?php
                 $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
           $kqq=oci_parse($conn,$sel);
           oci_execute($kqq);
            $idus=0;
        while($row=oci_fetch_row($kqq)){
          $idus=$row[0];}
          $find="SELECT CURRENT_SALARY FROM USERS WHERE ID=$idus";
          $run=oci_parse($conn, $find);
          oci_execute($run);
          $value="";
          while($row=oci_fetch_row($run)){
                 $value=$row[0];
          }
          echo $value;?>
             </p></td></tr>
             <tr><td><label>Mức lương mong đợi:</label></td><td><p>
               <?php
                 $email=$_COOKIE['email'];
           $sel="SELECT ID FROM USERS WHERE EMAIL='$email'";
        $kqq=oci_parse($conn,$sel);
        oci_execute($kqq);
        $idus=0;
        while($row=oci_fetch_row($kqq)){
          $idus=$row[0];}
          $find="SELECT EXPECTED_SALARY FROM USERS WHERE ID=$idus";
          $run=oci_parse($conn, $find);
          oci_execute($run);
          $value="";
          while($row=oci_fetch_row($run)){
                 $value=$row[0];
          }
          echo $value;?>
             </p></td></tr>
            <tr><td>
              <?php if(isset($_SESSION['mailtd'])){
                      $em=$_SESSION['mailtd']; 
                      echo'<a href="guiemail.php?email='.$em.'">Gửi</a>'; 
                    }else{
                      echo '<a href="index.php">Trang chủ</a>';
                    }
              ?></td></tr>
            </table>
   </form>  