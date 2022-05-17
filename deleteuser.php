<?php

session_start();
include 'DB.php';

if(!isset($_SESSION['user'])){
    
    header('Location: error.php');
}

if(isset($_GET['Username']))
{
	$uname = $_GET['Username']; 
        
	$query = "DELETE FROM accounts WHERE Username='$uname'";
        
	$res = mysqli_query($con, $query);
	if($res)
	{
		$status=Query($uname,$con);
	}
	else
	{
		$status="notdone";
	}

        
        header("Location: adminPro.php?status=$status");
       

}



function Query($uname,$con){
    
    $query = "DELETE FROM saved WHERE User='$uname' ";
                $result = mysqli_query($con, $query);
                
                if($result){
                    $query = "DELETE FROM member WHERE username='$uname'";
                       $result = mysqli_query($con, $query);
                       
                       if($result){
                           $query = "DELETE FROM poster WHERE Author='$uname'";
                            $result = mysqli_query($con, $query);
                            if($result){
                           $query = "DELETE FROM clubs WHERE Leader='$uname'";
                            $result = mysqli_query($con, $query);
                                    if($result){
                                       $query = "DELETE FROM clubrequest WHERE Leader='$uname'";
                                        $result = mysqli_query($con, $query);
                                                if($result){
                                               $query = "DELETE FROM request WHERE Username='$uname'";
                                                $result = mysqli_query($con, $query);
                                                    if($result){
                                                       $query = "SELECT * FROM comments WHERE user='$uname'";
                                                        $result = mysqli_query($con, $query);
                                                       // $id = mysqli_fetch_row($result1);

                                                        while ($id = mysqli_fetch_assoc($result)){
                                                            $i=$id['comment_id'];
                                                            $query = "DELETE FROM comments WHERE parent_comment_id='$i'";
                                                             $result = mysqli_query($con, $query);
                                                            }
                                                                $query = "DELETE FROM comments WHERE user='$uname'";
                                                                $result = mysqli_query($con, $query);
                                                                if($result){
                                                                    return "done";
                                                                }
                                                        }
                                                         else {
                                                             return "notdone";
                                                         }
                                                 }                                         }
                                         else{
                                             return "notdone";
                                         }
                             }
                             else{
                                 return "notdone";
                             }
                       }
                        else {
                           return "notdone";
                        }
                    
                }
                 else {
                    return "notdone";
                 }
    
    
}

?>







