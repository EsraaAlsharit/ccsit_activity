<?php

//fetch_user.php

//include('database_connection.php');
include './DB.php';
$connect = new PDO("mysql:host=localhost;dbname=pro", "root", "");
session_start();

$uname=$_SESSION['user'];

$query="SELECT club FROM member WHERE Username='$uname' LIMIT 1";
$result1 = mysqli_query($con, $query);
	$club = mysqli_fetch_row($result1)[0];


$result = mysqli_query($con, $query);

  

//  $result= $connect->prepare($query);
  //$result->execute();
  
  $row=$result->fetcharray();
         // mysqli_fetch_array($result);
                $dbname=$row['club'];

$query = "SELECT * FROM accounts 
WHERE Username != '".$_SESSION['user']." AND SELECT * FROM member WHERE club= '".$dbname."'";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-bordered table-striped">
	<tr>
		<th width="70%">Username</td>
		<th width="20%">Status</td>
		<th width="10%">Action</td>
	</tr>
';

foreach($result as $row)
{
	$status = '';
	$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
	$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
	$user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
	if($user_last_activity > $current_timestamp)
	{
		$status = '<span class="label label-success">Online</span>';
	}
	else
	{
		$status = '<span class="label label-danger">Offline</span>';
	}
	$output .= '
	<tr>
		<td>'.$row['username'].' '.count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).' '.fetch_is_type_status($row['user_id'], $connect).'</td>
		<td>'.$status.'</td>
		<td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'">Start Chat</button></td>
	</tr>
	';
}

$output .= '</table>';

echo $output;

?>