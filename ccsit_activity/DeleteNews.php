<?php
session_start();
include './DB.php';

if(!isset($_SESSION['user'])){
    
    header('Location: error.php');
}
$U=$_SESSION['user'];
    if(!$U=='admin'){
        header("Location: error.php");
    }

if(isset($_GET['No']))
{
	$id = $_GET['No']; //107

	$query1 = "SELECT Img FROM news WHERE No='$id'";
	$result1 = mysqli_query($con, $query1);
	$img = mysqli_fetch_row($result1)[0];

        
	$query = "DELETE FROM news WHERE No='$id'";
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

	header("Location: adminPro.php?status=$status");
}

function Query($id,$con){
    
    $query = "DELETE FROM saved WHERE No='$id' AND Class='news'";
                $result = mysqli_query($con, $query);
                
                if($result){
                    $query = "DELETE FROM comments WHERE No='$id' AND Class='news'";
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