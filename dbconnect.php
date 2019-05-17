<?php
  $newjob = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521)))(CONNECT_DATA=(SID=ORCL)))";

   $conn=oci_connect("job","1234", $newjob,'AL32UTF8') or die ("Connection failed: " . oci_error());                     
?>
 