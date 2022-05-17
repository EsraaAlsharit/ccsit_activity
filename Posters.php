<html>
    <head>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <?php

$title = "Item Description";
include 'Header.php';

if(isset($_GET['No']))
{

    $id = $_GET['No'];
    $query = "SELECT * FROM poster WHERE No=$id";
    $result = mysqli_query($con, $query);
    $post= array();
    while($row = mysqli_fetch_assoc($result))
    {

        $post = array(
                    'no'=>$row['No'],
                    'title' => $row['Title'],
                    'des'=>$row['Description'],
                    'place'=>$row['Place'],
                    'img'=>$row['Img'],
                    'time'=>$row['Time'],
                    'aother'=>$row['Author'],
                    'date'=>$row['Date'],
                    'end'=>$row['DateEnd']
                    );

    }
}

if(isset($_GET['No'],$_GET['save'])) {
    $uname=$_SESSION['user'];
    $No=$_GET['No'];
    $query = "INSERT INTO saved (User, No, Class ) VALUES ('$uname','$No' ,'poster' )";
    $result = mysqli_query($con, $query);
    
    if($result){
        ?>
         <script> alert('saved successfully')</script><?php
        
    }
 else {?>
     <script> alert('not saved' )</script>    
   <?php }
}

?>
     </head>
     <body>
     
<div id="content">

<div class="section page">

    <div class="wrapper">
         <?php if(isset($_SESSION['user'])){ ?>
        <div class="shirt-details">
            <form action="Posters.php" method="GET" >
            <button name="save" ><img src="img/save.png" width="30px" ></button>
            <input type="hidden" name="No" value="<?php echo $post['no']; ?>"/>
            
            </form>
            
                </div>
        <?php } ?>

	<div class="shirt-picture">
		<span>
                    <img src="<?php echo $post['img']; ?>" alt="<?php echo $post['title']; ?>">
		</span>
	</div>
	<div class="shirt-details">

		<h1><span ><?php echo $post['title']; ?></span></h1>
                <p><?php echo nl2br($post['des']); ?></p>
                <p><b>Place</b> : <?php echo $post['place']; ?></p>
                
                <p><b>Time</b> : <time><?php echo $post['time']; ?></time> </p>
                <p><b>Date</b> : <data><?php echo $post['date']; ?></data> - <data><?php echo $post['end']; ?></data></p>
                <h3><?php echo $post['aother']; ?></h3>
	</div>
    </div>
</div>
    <?php if(isset($_SESSION['user'])){ ?>
      <div class="container">
        <form method="POST" id="comment_form" name="comment_form">
       <table>
           <tr>
               <th>
    <div class="form-group">
        <input type="text" name="comment_name" class="form-control" width="50%" readonly="" value="<?php echo $_SESSION['user']; ?>" />
        <span  id="comment_name" ></span>
    </div></th></tr>
           <tr>
             <th>  
    <div class="form-group">
        <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5" cols="50"></textarea>
        <span class="error" id="commentcontent"></span>
    </div>
            </th>   </tr>
      <tr>
          <td>
    <div class="form-group">
     <input type="hidden" name="comment_id" id="comment_id" value="0" >
     <input type="hidden" name="no" id="no" value="<?php echo $post['no']; ?>" >
     <input type="hidden" name="class" id="class" value="poster" >
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
        
        
    </div>
        </td>
    </tr>     
      </table>     
   </form>
   <span id="comment_message"></span>
  
   <br>
   
   <div id="display_comment">
       
    
       </div>
  </div>
    <?php } ?>
    
</div>
         </body>
         </html>
<?php include './Footer.php'; ?>
  <script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
     var Nos = document.comment_form.no.value;
     var classes = document.comment_form.class.value;
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   data:{ no: Nos , clas: classes },
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_content').focus();
 });
 
});
</script> 