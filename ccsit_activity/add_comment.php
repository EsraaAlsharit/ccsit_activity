<?php

//add_comment.php

include 'DB.php';

$error = '';
$comment_name = $_POST['comment_name'];
$comment_content = '';

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger" style="text-align: center;">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
}
$commId=$_POST["comment_id"];
$no= $_POST['no'];
$class= $_POST['class'];

if($error == ''){
    
 $query = "
 INSERT INTO comments(parent_comment_id, Comment, user, No , Class ) 
 VALUES ( '$commId', '$comment_content', '$comment_name' , '$no' , '$class' )";
 $result= mysqli_query($con, $query);

 $error = '<p class="text-success" style="text-align: center;" >Comment Added</p>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>