<?php

 $servername="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="jbcnmun22";  
 
// $servername="localhost";
// $dbUsername="u429279072_iyc";
// $dbPassword="2y!0?ng/0]Fd";
// $dbName="u429279072_iyc2021";    
  
$conn = mysqli_connect($servername,$dbUsername,$dbPassword,$dbName);

if(!$conn){
    die("Database Connection Failed:". mysqli_connect_error());
}


