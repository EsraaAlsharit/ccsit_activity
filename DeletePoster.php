<?php
session_start();
include './DB.php';

if(!isset($_SESSION['user'])){
    
    header('Location: error.php');
}

if(isset($_GET['No']))
{
	$id = $_GET['No']; //107
        $U=$_SESSION['user'];
	$query1 = "SELECT Img FROM poster WHERE No='$id'";
	$result1 = mysqli_query($con, $query1);
	$img = mysqli_fetch_row($result1)[0];

	$query = "DELETE FROM poster WHERE No='$id'";
	$result = mysqli_query($con, $query);
	if($result==1)
	{
		
			if(file_exists($img))
		{
			if(!unlink($img)){
                         
                            $status="notdone";
                            
                        }
                else {
                    $status=Query($id,$con);   
                }
                        
		}
                else {
                 $status=Query($id,$con);   
                }
	}
	else
	{
		$status="notdone";
	}

        if($U=='admin')
                header("Location: adminPro.php?status=$status");
                else
                header("Location: userPro.php?status=$status");
	
}

function Query($id,$con){
    
    $query = "DELETE FROM saved WHERE No='$id' AND Class='poster'";
                $result = mysqli_query($con, $query);
                
                if($result){
                    $query = "DELETE FROM comments WHERE No='$id' AND Class='poster'";
                       $result = mysqli_query($con, $query);
                       
                       if($result){
                           return "done"; 
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