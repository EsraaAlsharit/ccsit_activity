<?php



//include 'DB.php';

//$no= $_POST['no'];
//$class= $_POST['class'];

$connect = new PDO('mysql:host=localhost;dbname=pro', 'root', '');

$nos=$_POST['no'];
$classes=$_POST['clas'];

$query = "SELECT * FROM comments WHERE parent_comment_id = '0' AND No= '$nos' AND Class= '$classes'  ORDER BY comment_id DESC";

   $statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $i)
{
 $output .= " 
 <div class='panel panel-default'>
  <div class='panel-heading'>By <b>".$i['user']."</b> on <i>".$i["date"]."</i></div>
  <div class='panel-body'>".$i["comment"]."</div>
  <div class='panel-footer' align='right'><button type='button' class='btn btn-default reply' id='".$i["comment_id"]."'>Reply</button></div>
 </div>";
 $output .= get_reply_comment($connect , $i["comment_id"]);
}

echo $output;

function get_reply_comment($connect , $parent_id = 0, $marginleft = 0)
{
   
 $query = " SELECT * FROM comments WHERE parent_comment_id = '".$parent_id."' ";
 $output = '';
 $statement = $connect->prepare($query);
 
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .= '<div class="panel panel-default" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading">By <b>'.$row["user"].'</b> on <i>'.$row["date"].'</i></div>
    <div class="panel-body">'.$row["comment"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
   </div>
   ';
   $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
  }
 }
 return $output;
}

?>