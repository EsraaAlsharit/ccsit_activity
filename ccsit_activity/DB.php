<?php
$host="localhost";
$user="root";
$pwd="";
$db="pro";

$con= mysqli_connect($host, $user, $pwd, $db);

if(mysqli_connect_errno($con)){
    echo mysqli_connect_error();
}
 else {
   // echo 'concted to db';
}

//$query='SELECT * fRO stuff';
//$result= mysqli_query($con, $query);

//mysqli_fetch_assoc($result);
?>





