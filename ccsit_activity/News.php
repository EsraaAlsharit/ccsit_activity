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
    $query = "SELECT * FROM news WHERE No=$id";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result))
    {

        $news = array(
                    'no'=>$row['No'],
                    'title' => $row['Title'],
                    'details'=>$row['Details'],
                    'img'=>$row['Img'],
                    'date'=>$row['Date']
                    );
    }
}

if(isset($_GET['No'],$_GET['save'])) {
    $uname=$_SESSION['user'];
    $No=$_GET['No'];
    $query = "INSERT INTO saved (User, No, Class ) VALUES ('$uname','$No' ,'news' )";
    $result = mysqli_query($con, $query);
    
    if($result){
        ?>
         <script> alert('saved successfully' )</script><?php
        
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
            <form action="News.php" method="GET">
            <button name="save" ><img src="img/save.png" width="30px" ></button>
            <input type="hidden" name="No" value="<?php echo $news['no']; ?>"/>
            
            </form>
            
                </div>
        <?php } ?>
        
	<div class="shirt-picture">
		<span>
                    <img width="90%" src="<?php echo $news['img']; ?>" alt="<?php echo $news['title']; ?>">
		</span>
	</div>
	<div class="shirt-details">

		<h1><span ><?php echo $news['title']; ?></span></h1>
                <p><?php echo nl2br($news['details']); ?></p><br>
                <data><?php echo $news['date']; ?></data>
	</div>
        
        
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
     <input type="hidden" name="no" id="no" value="<?php echo $news['no']; ?>" >
     <input type="hidden" name="class" id="class" value="news" >
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


</body>

<?php include './Footer.php'; ?>
</html>

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