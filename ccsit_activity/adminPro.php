<html>
    <head>
        
     <?php 
     use PHPMailer\PHPMailer\PHPMailer;
        require_once 'PHPMailer/PHPMailer.php';
        require_once 'PHPMailer/SMTP.php';
        require_once 'PHPMailer/Exception.php';
     $title="admin profile";
     include 'Header.php'; 
     
    if(!isset($_SESSION['user'])){
     header("Location: error.php");
    }
    $U=$_SESSION['user'];
    if(!$U=='admin'){
        header("Location: userPro.php");
    }
    
    if(isset($_POST['addnew'])){

        $title = $_POST['title'];
        $detail = $_POST['detail'];
        $date = $_POST['date'];

        if(!empty($_FILES['image']['name'])){

                $filename = $_FILES['image']['name'];
                $tmp  = $_FILES['image']['tmp_name'];
                $size = $_FILES['image']['size'];
                $error = $_FILES['image']['error'];
                $type = $_FILES['image']['type'];



                //STEP 1: Construct the Destination Path
                $path = "img/news/";
                $path = $path.basename($filename);

                //CHECK FILE TYPE FROM EXTENSION
                $accepted = array('png','jpg','jpeg','gif');
                $ext_array = explode(".", $path);
                $extension = end($ext_array);
                $result = in_array($extension,$accepted);

                //STEP 2: CHECK 3 FACTORS: SIZE, TYPE and ERROR
                if($size <= 500000 && ($result==1) && ($error==0))
                {

            //STEP 3: Move the uploaded file
            $out = move_uploaded_file($tmp, $path);        

            if($out==1)
            {
                //STEP 4: Create the Query
                $query = "INSERT INTO news ( Title, Details, Img, Date) VALUES ( '$title', '$detail' , '$path' , '$date' )";

                //STEP 5: Run the Query
                $res = mysqli_query($con, $query);        

                //STEP 6: Check the result
                if($res==1)
                {
                    $status = "done";
                }
                else
                {
                    $status = "notdone";
                }
            }
            else
            {
            $status="notdone";
            }  


        }
        else
            {
            $status="notdone";
            } 

        }
        else{

            $query = "INSERT INTO news ( Title, Details, Img, Date) VALUES ('$title', '$detail' , '' , '$date')";
            $res = mysqli_query($con, $query);  

        if($res==1)
            $status = "done";
         else
            $status = "notdone";


        }

        header("Location: adminPro.php?status=$status");

    }
    //add new

    if(isset($_POST['addpost'])){


        $title = $_POST['title'];
        $des = $_POST['des'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        $Edate = $_POST['edate'];
        $place = $_POST['Place'];


        if(!empty($_FILES['image']['name'])){

                $filename = $_FILES['image']['name'];
                $tmp  = $_FILES['image']['tmp_name'];
                $size = $_FILES['image']['size'];
                $error = $_FILES['image']['error'];
                $type = $_FILES['image']['type'];



                //STEP 1: Construct the Destination Path
                $path = "img/posters/";
                $path = $path.basename($filename);

                //CHECK FILE TYPE FROM EXTENSION
                $accepted = array('png','jpg','jpeg','gif');
                $ext_array = explode(".", $path);
                $extension = end($ext_array);
                $result = in_array($extension,$accepted);

                //STEP 2: CHECK 3 FACTORS: SIZE, TYPE and ERROR
                if($size <= 500000 && ($result==1) && ($error==0))
                {

            //STEP 3: Move the uploaded file
            $out = move_uploaded_file($tmp, $path);        

            if($out==1)
            {
                //STEP 4: Create the Query
                $athor=$_SESSION['user'];
                $query = "INSERT INTO poster( Title, Description, Place, Time ,Date , DateEnd , Img, Author) VALUES ('$title', '$des' , '$place' , '$time' , '$date', '$Edate'  , '$path', '$athor' )";


                $res = mysqli_query($con, $query);        

                //STEP 6: Check the result
                if($res==1)
                {
                    $status = "done";
                }
                else
                {
                    $status = "notdone";
                }
            }
            else
            {
            $status="notdone";
            }  


        }
        else
            {
            $status="notdone";
            } 

        }
        else{

            $athor=$_SESSION['user'];
            $query = "INSERT INTO poster (Title, Description, Place,Time ,Date, DateEnd , Img, Author) VALUES ('$title', '$des' , '$place' , '$time' , '$date', ' $Edate', ' ' , '$athor')";

            $res = mysqli_query($con, $query);  

        if($res==1){
        $status = "done";}
         else{
         $status = "notdone";}


        }

        header("Location: adminPro.php?status=$status");

    }
    //add poster

    if(isset($_POST['accept'])){

        $un=$_POST['user'];
        $club=$_POST['club'];
        $query="INSERT INTO member(username, club) VALUES ('$un', '$club' )";

        $result= mysqli_query($con, $query);
        

        if($result){
            $query= "DELETE FROM request WHERE Username='$un'";

            $result = mysqli_query($con,$query);



            if($result){
                $query="SELECT * FROM accounts WHERE Username='$un' LIMIT 1";
                $result= mysqli_query($con, $query);
                
                $row= mysqli_fetch_array($result);
                
                
                $db_fname=$row['Fname'];
                $db_email=$row['Email'];
          
                
                $mail = new PHPMailer;

            //$mail->IsSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'ccsit.kfu.activity@gmail.com';          // SMTP username
            $mail->Password = 'ccsit2019'; // SMTP password
            $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = /*'587';*/'465';                          // TCP port to connect to

            $mail->setFrom($db_email , 'Request to join');
            $mail->addAddress( $db_email );   // Add a recipient


            $mail->IsHTML(true);  // Set email format to HTML
            $bodyContent = '<h1>Dear, '.$db_fname.'</h1>';
            $bodyContent .= '<p>This is email to let you know your request has accepted.</p>';
            $bodyContent .= '<p>welcome in <b>'.$club.'</b></p>';

            $mail->Subject = 'Email from CCSIT Activity suppuort system';
            $mail->Body    = $bodyContent;
            $mail->send();
            
             header("Location: adminPro.php?status=done");
             //send email
            }
            else {
             header("Location: adminPro.php?status=notdone");   
            }
        }
     else {header("Location: adminPro.php?status=notdone");
      }


    }
    //accept request

    if(isset($_POST['notaccept'])){
        $un=$_POST['user'];
        $club=$_POST['club'];
        $query= "DELETE FROM request WHERE Username='$un'";

            $result = mysqli_query($con,$query);
            if($result){
                //send email
                $query="SELECT * FROM accounts WHERE Username='$un' LIMIT 1";
                $result= mysqli_query($con, $query);
                
                $row= mysqli_fetch_array($result);
                
                
                $db_fname=$row['Fname'];
                $db_email=$row['Email'];
          
                
                $mail = new PHPMailer;

            //$mail->IsSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'ccsit.kfu.activity@gmail.com';          // SMTP username
            $mail->Password = 'ccsit2019'; // SMTP password
            $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = /*'587';*/'465';                          // TCP port to connect to

            $mail->setFrom($db_email , 'Request to join');
            $mail->addAddress( $db_email );   // Add a recipient


            $mail->IsHTML(true);  // Set email format to HTML
            $bodyContent = '<h1>Dear, '.$db_fname.'</h1>';
            $bodyContent .= '<p>This is email to let you know your request has rejection for join <b>'.$club.'</b>.</p>';
            $bodyContent .= '<p>sorry.</p>';

            $mail->Subject = 'Email from CCSIT Activity suppuort system';
            $mail->Body    = $bodyContent;
            $mail->send();
                header("Location: adminPro.php?status=done");
            }
            else {
                header("Location: adminPro.php?status=notdone");
            }

    }
    //not accept request
    
    if(isset($_POST['accountu'],$_POST['delete'])){
    header('Location: deleteuser.php?Username='.$_POST['accountu']);
}

    if(isset($_POST['sol'])){
    
    $No=$_POST['status'];
    $query= "DELETE FROM problem WHERE No= $No";
        
        $result = mysqli_query($con,$query);
    header("Location: adminPro.php?status=done");
}
    
    if(isset($_POST['deletesaved'])){
       $No= $_POST['no'];
        $class=$_POST['class'];
        
        $query= "DELETE FROM saved WHERE No='$No' AND Class='$class'";
        $result= mysqli_query($con, $query);
        
        if ($result){
            header("Location: adminPro.php?status=done");
        }
    }
    
   if(isset($_POST['acceptclub'])){

        $No=$_POST['no'];
        $Query = "SELECT * FROM clubrequest WHERE No=$No LIMIT 1";
        
        $result = mysqli_query($con,$Query);

            if($result){
                 
                $row= mysqli_fetch_array($result);

                 $db_name=$row['Name'];
                $db_about=$row['About'];
              $db_vis= $row['Vision'];
                $db_mis=$row['Mission'];
               $db_obj =$row['Objectives'];
            $db_prog =  $row['Programs'];
            $db_req  =  $row['Requirements'];
            $db_adv   = $row['Advantages'];
            $db_lead     =$row['Leader'];
             $db_img   =$row['Img'];
             
             $query = "INSERT INTO clubs( Name, About, Vision, Mission ,Objectives , Programs , Requirements , Advantages, Img, Leader) VALUES ('$db_name', '$db_about' , '$db_vis' , '$db_mis' , '$db_obj', '$db_prog' , '$db_req','$db_adv' , '$db_img', '$db_lead' )";
            
            $result = mysqli_query($con,$query);
            
                if($result){
                    
                    $query="INSERT INTO member(username, club) VALUES ('$db_lead', '$db_name' )";
                    $result = mysqli_query($con,$query);
                    if($result){
                         $query= "DELETE FROM request WHERE No='$No'";
                         $result = mysqli_query($con,$query);
                         
                         If($result){
                    $query="SELECT * FROM accounts WHERE Username='$db_lead' LIMIT 1";
                    $result= mysqli_query($con, $query);

                    $row= mysqli_fetch_array($result);


                    $db_fname=$row['Fname'];
                    $db_email=$row['Email'];


                    $mail = new PHPMailer;

                //$mail->IsSMTP();                            // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                     // Enable SMTP authentication
                $mail->Username = 'ccsit.kfu.activity@gmail.com';          // SMTP username
                $mail->Password = 'ccsit2019'; // SMTP password
                $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port = /*'587';*/'465';                          // TCP port to connect to

                $mail->setFrom($db_email , 'Request to join');
                $mail->addAddress( $db_email );   // Add a recipient


                $mail->IsHTML(true);  // Set email format to HTML
                $bodyContent = '<h1>Dear, '.$db_fname.'</h1>';
                $bodyContent .= '<p>This is email to let you know your request has accepted.</p>';
                $bodyContent .= '<p>and your club has been created</p>';

                $mail->Subject = 'Email from CCSIT Activity suppuort system';
                $mail->Body    = $bodyContent;
                $mail->send();

                 header("Location: adminPro.php?status=done");
                 //send email
                }
                else {
                    header("Location: adminPro.php?status=notdone");
                }
                    }
                    else {
                         header("Location: adminPro.php?status=notdone");
                    }
                }
                else {
                    header("Location: adminPro.php?status=notdone");
                }
            }
            else {
                header("Location: adminPro.php?status=notdone");
            }
      
                
     }   
    //accept request

    if(isset($_POST['notacceptclub'])){
        
        $No=$_POST['no'];
        $Query = "SELECT * FROM clubrequest WHERE No=$No LIMIT 1";
        
        $result = mysqli_query($con,$Query);

        if($result){
            $row= mysqli_fetch_array($result);

                 $db_name=$row['Name'];
                $db_lead=$row['Leader'];
                
                $query= "DELETE FROM clubrequest WHERE No='$No'";

                
                $result = mysqli_query($con,$query);
                
            if($result){
                //send email
                $query="SELECT * FROM accounts WHERE Username='$db_lead' LIMIT 1";
                $result= mysqli_query($con, $query);
                
                $row= mysqli_fetch_array($result);
                
                
                $db_fname=$row['Fname'];
                $db_email=$row['Email'];
          
                
                $mail = new PHPMailer;

            //$mail->IsSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'ccsit.kfu.activity@gmail.com';          // SMTP username
            $mail->Password = 'ccsit2019'; // SMTP password
            $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = /*'587';*/'465';                          // TCP port to connect to

            $mail->setFrom($db_email , 'Request to join');
            $mail->addAddress( $db_email );   // Add a recipient


            $mail->IsHTML(true);  // Set email format to HTML
            $bodyContent = '<h1>Dear, '.$db_fname.'</h1>';
            $bodyContent .= '<p>This is email to let you know your request has rejection for crate <b>'.$db_name.'</b>.</p>';
            $bodyContent .= '<p>sorry.</p>';

            $mail->Subject = 'Email from CCSIT Activity suppuort system';
            $mail->Body    = $bodyContent;
            $mail->send();
                header("Location: adminPro.php?status=done");
            }
            else {
              header("Location: adminPro.php?status=notdone");   
            }
                
        }
        
        else {
           header("Location: adminPro.php?status=notdone"); 
        }
                
    }
    //not accept request


    if(isset($_GET['status']) && $_GET['status']==="done") { ?>  
    <script> alert('process done successfully' )</script>
    
    <?php } if(isset($_GET['status']) && $_GET['status']==="notdone") { ?>
    <script> alert('Sorry process not done' )</script>
    
    <?php } ?>
    

    </head>

   <body>

<h1>Proflie</h1>

<div class="tab" >
  <button class="tablinks" onclick="openTab(event, 'account')" >Accounts</button>
  <button class="tablinks" onclick="openTab(event, 'post')">Poster</button>
  <button class="tablinks" onclick="openTab(event, 'news')">News</button>
  <button class="tablinks" onclick="openTab(event, 'addpost')">Add Poster</button>
  <button class="tablinks" onclick="openTab(event, 'addnew')">Add News</button>
  <!--button class="tablinks" onclick="openTab(event, 'comm')">Comment</button-->
  <button class="tablinks" onclick="openTab(event, 'Save')">Saved</button>
  <!--button class="tablinks" onclick="openTab(event, 'mass')">Massage</button-->
  <button class="tablinks" onclick="openTab(event, 'pro')">Problem</button>
  <button class="tablinks" onclick="openTab(event, 'reqjion')">Request to join club</button>
  <button class="tablinks" onclick="openTab(event, 'modifiyclub')">Club</button>
  <button class="tablinks" onclick="openTab(event, 'reqcreate')">Request create club</button>
</div>

<div id="account" class="tabcontent ">
    <?php
    $query = "SELECT * FROM accounts";
    $result = mysqli_query($con,$query);
    $users = array();

    while($row = mysqli_fetch_assoc($result)){

    $users[$row['ID']] = array(
                    'id' => $row['ID'],
                    'uname'=>$row['Username'],
                    'fname' => $row['Fname'],
                    'lname'=>$row['Lname'],
                    'em' => $row['Email'],
                    'pass'=>$row['Pass'],
                    'magor' => $row['Magor'],
                    'level'=>$row['Level']
                    );

    }

 
  if(!empty($users)){  
?>  
<div class="content">
  <div class="page section">
    <h3>Accounts</h3>
    
    <form id="contact" name="modify" method="POST" action="adminPro.php">
        <table>                        
            <?php foreach($users as $i) {?>
                <tr>
                    <th>
                        <input type="radio" name="accountu" value="<?php echo $i['uname']; ?>"/>
                    </th>
                    <td>
                        <label><?php echo $i['uname'] ?></label>
                    </td>
                </tr>
            <?php } ?>                                            
        </table>
        <!--input type="submit" name ="update" value="Add User" -->
        <input type="submit" name="delete"  value="Delete User">
    </form>   
   </div>
  <?php } else { ?>
<h3>there is no account</h3> 
<?php } ?>
</div>
</div>
  

</div>

<div id="post" class="tabcontent">
  <h3>All Posters are Share</h3>
<?php 
    $Query = "SELECT * FROM poster";


$result = mysqli_query($con,$Query);
$Post = array();

while($row = mysqli_fetch_assoc($result))
{

$Post[$row['No']] = array(
                    'no'=>$row['No'],
                    'title' => $row['Title'],
                    'des'=>$row['Description'],
                    'place'=>$row['Place'],
                    'img'=>$row['Img'],
                    'time'=>$row['Time'],
                    'aother'=>$row['Author'],
                    'date'=>$row['Date'],
                    //'end'=>$row['DateEnd']
                    );

}
if(!empty ($Post)){
?>
          <div class="content">
            
<div class="page shirts section">
    <div class="wrapper">
            
            <ul class="products">
           
                <?php foreach($Post as $i) {?>
            <li>
                  
                <p><?php echo $i['title'];?></p>
                <img src="<?php echo $i['img']; ?>" alt="<?php echo $i['title']; ?>"/>
                <a href="Posters.php?No=<?php echo  $i['no']; ?>">View Details</a>
                <a href="ModifyPoster.php?No=<?php echo  $i['no']; ?>">Modify Poster</a>
                <a href="DeletePoster.php?No=<?php echo  $i['no']; ?>">Delete Poster</a>
            </li>
            <?php } ?>
            </ul>
            
              </div>
    </div>
<?php } 
 else { ?>
              <h3>there is no poster</h3>
 <?php
 } ?>
         </div>
  
</div>

<div id="news" class="tabcontent">
  <h3>All New are Share</h3>
<?php 
    $Query = "SELECT * FROM news";


$result = mysqli_query($con,$Query);
$News = array();

while($row = mysqli_fetch_assoc($result))
{

$News[$row['No']] = array(
                    'no'=>$row['No'],
                    'title' => $row['Title'],
                    'details'=>$row['Details'],
                    'img'=>$row['Img'],
                    'date'=>$row['Date']
                    );

}

if(!empty($News)){ ?>
          <div class="content">
            
<div class="page shirts section">
    <div class="wrapper">
            
            <ul class="products">
           
                <?php foreach($News as $i) {?>
            <li>
                  
                <p><?php echo $i['title'];?></p>
                <img src="<?php echo $i['img']; ?>" alt="<?php echo $i['title']; ?>"/>
                <a href="News.php?No=<?php echo  $i['no']; ?>">View Details</a>
                <a href="ModifyNews.php?No=<?php echo  $i['no']; ?>">Modify News</a>
                <a href="DeleteNews.php?No=<?php echo  $i['no']; ?>">Delete News</a>
            </li>
            <?php } ?>
            </ul>
            
              </div>
    </div>
              <?php } 
 else { ?>
              <h3>there is no news</h3>
 <?php
 } ?>
         </div>
  
</div>

<!--div id="comm" class="tabcontent">
  <h3>Your Comments</h3>
  all
</div-->
   
<div id="addpost" class="tabcontent">
  
  
  <div id="content">
<div class="breadcrumb">
<div class="page section">
    <h3>Create Poster</h3>
    
    <form  name="post" method="POST" action="adminPro.php" enctype="multipart/form-data" onsubmit=" return validate_poster();">

                    <table>
                        
                        <tr>
                            <th>
                                <label for="title">Title</label>
                            </th>
                            <td>
                                <input type="text" name="title" id="title">
                                <span class="error" id="Ptitle" style="visibility: hidden">* Required </span>
                            </td>
                        </tr>
                        
                         <tr>
                            <th>
                                <label for="des">Description</label>
                            </th>
                            <td>
                                <textarea name="des" cols="50" rows="15" id="des"></textarea>
                                    <span class="error" id="Pdes" style="visibility: hidden">* Required </span>
                            </td>
                        </tr>
                        
                        <tr>
                            <th>
                                <label for="Place">Place</label>
                            </th>
                            <td>
                                <input type="text" name="Place" id="Place">
                                <span class="error" id="Place" style="visibility: hidden">* Required </span>
                            </td>
                        </tr>
                        
                        <tr>
                            <th>
                                <label for="Place">Time</label>
                            </th>
                            <td>
                                <input type="time" name="time" id="time">
                                <span class="error" id="time" style="visibility: hidden">* Required </span>
                            </td>
                        </tr>
                        
                                                
                        <tr>
                            <th>
                                <label for="price">Start Date</label>
                            </th>
                            <td>
                                <input type="date" name="date" id="date">
                                <span class="error" id="Sdate" style="visibility: hidden">* Required </span>
                                
                            </td>
                        </tr>                    

                        <tr>
                            <th>
                                <label for="price">End Date</label>
                            </th>
                            <td>
                                <input type="date" name="edate" id="date">
                                <span class="error" id="Edate" style="visibility: hidden">* Required </span>
                            </td>
                        </tr>  
                        <tr>
                            <th>
                                <label for="image">Upload Image</label>
                            </th>
                            <td>
                                <input type="file" name="image" id="image">
                                <span style="font-size: 0.6em; font-style: italic;">(Maximum 500 KB)</span>
                            </td>
                        </tr>
                        
                        
                        
                    </table>
                    <input type="submit" value="Add" name="addpost" id="addpost"/>

                </form>
           
</div>
</div>
  
</div>
  
  
  
</div>

<div id="addnew" class="tabcontent">
  <div id="content">
<div class="breadcrumb">
<div class="page section">
    <h3>Create News</h3>
    
    <form id="contact" name="news" method="POST" action="adminPro.php" enctype="multipart/form-data" onsubmit="return validate_news();">

                    <table>
                        
                        <tr>
                            <th>
                                <label for="title">Title</label>
                            </th>
                            <td>
                                <input type="text" name="title" id="name">
                                <span class="error" id="Ntitle" style="visibility: hidden">* Required </span>
                            </td>
                        </tr>
                        
                         <tr>
                            <th>
                                <label for="detail">Details</label>
                            </th>
                            <td>
                                <textarea name="detail" cols="50" rows="15"></textarea>
                                <span class="error" id="det" style="visibility: hidden">* Required </span>
                                    
                            </td>
                        </tr>
                        
                        <tr>
                            <th>
                                <label for="image">Upload Image</label>
                            </th>
                            <td>
                                <input type="file" name="image" id="image">
                                <span style="font-size: 0.6em; font-style: italic;">(Maximum 500 KB)</span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="price">Date</label>
                            </th>
                            <td>
                                <input type="date" name="date" id="price">
                                <span class="error" id="Ndate" style="visibility: hidden">* Required </span>
                                
                            </td>
                        </tr>                    
                    </table>
                    <input type="submit" value="Add" name="addnew" id="add"/>

                </form>
           
</div>
</div>
  </div>
</div>



<div id="pro" class="tabcontent">
  <div id="content">
<div class="tables">
<div class="page section">
    <h3>Problem List Details</h3>
          <?php $query= "SELECT * from Problem";
        
        $result = mysqli_query($con,$query);
$pro = array();

while($row = mysqli_fetch_assoc($result))
{
    
$pro[$row['No']] = array(
                    'no'=>$row['No'],
                    'email' => $row['Email'],
                    'des'=>$row['Description'],
                    'sub'=>$row['Subject']
                   
                    );

}
if(!empty($pro)){


?>
    
    <form id="contact" name="pro" method="POST" action="adminPro.php" >
    <table>
        <tr>
            <th>
                <label for="no">Email</label>
            </th>
            <th>
                <label for="no">Subject</label>
            </th>
            <th>
                <label for="no">Problem</label>
            </th>
            <th>
                <label for="no">Status</label>
            </th>
        </tr>
  
<?php
      
        foreach ($pro as $i){ ?>
        <tr>
            <td>
                <a href="mailto:<?php echo $i['email'] ?>"> <?php echo $i['email'] ?></a>  
            </td>
        
            <td>
                <label><?php echo $i['sub'] ?></label>
                
                
            </td>
            <td>
               <label><?php echo $i['des'] ?></label>
            </td>
            <td>
               
                    <input type="hidden" name="status" id="status" value="<?php echo $i['no']; ?>"/>
                      <input type="submit" value="solved" name="sol" >  
               
                
            </td>
        </tr>

         <?php }?>

        
    </table>
        </form>
<?php  } else { ?>
<h3>there is no problem</h3> 
<?php } ?>
</div>
</div>
  </div>
</div>


<div id="reqjion" class="tabcontent">
    
   
     <div id="content">
         <div class="tables ceas">
<div class="page section">
    <h3>Request to Clubs</h3>
    
    <?php 

$Query = "SELECT * FROM request ";


$result = mysqli_query($con,$Query);
$req = array();


while($row = mysqli_fetch_assoc($result))
{

$req[$row['No']] = array(
                    'uname'=>$row['Username'],
                    'id' => $row['ID'],
                    'fn'=>$row['Fname'],
                    'ln'=>$row['Lname'],
                    'email'=>$row['Email'],
                    'magor'=>$row['Magor'],
                    'level'=>$row['Level'],
                    'club'=>$row['Club']
                    );

}
    if(!empty($req)){ ?>
    <form id="contact" name="req" method="POST" action="adminPro.php" >
        <div class="tableslist" >
           
    <table  >
        <tr>
            <th>
                <label for="no">Username</label>
            </th>
            <th>
                <label for="no">ID</label>
            </th>
            <th>
                <label for="no">Frist Name</label>
            </th>
            <th>
                <label for="no">Last Name</label>
            </th>
            <th>
                <label for="no">Email</label>
            </th>
            <th>
                <label for="no">Magor</label>
            </th>
            <th>
                <label for="no">Level</label>
            </th>
            <th>
                <label for="no">Club</label>
            </th>
            <th>
                <label for="no">Status</label>
            </th>
 
        </tr>
    
  
       
          <?php   foreach ($req as $i){ ?>
        <tr>
            <td>
             <label><?php echo $i['uname'] ?></label>
            </td>
            <td>
               <label><?php echo $i['id'] ?></label>
            </td>
            <td>
             <label><?php echo $i['fn'] ?></label>
            </td>
            <td>
               <label><?php echo $i['ln'] ?></label>
            </td>
            <td>
                <a href="mailto:<?php echo $i['email'] ?>"> <?php echo $i['email'] ?></a>  
            </td>
        
            <td>
             <label><?php echo $i['magor'] ?></label>
            </td>
            <td>
               <label><?php echo $i['level'] ?></label>
            </td>
            <td>
             <label><?php echo $i['club'] ?></label>
            </td>
            
            <td>
                
                    <input type="hidden" name="user" value="<?php echo $i['uname']; ?>"/>
                    <input type="hidden" name="club" value="<?php echo $i['club']; ?>"/>
                      <input type="submit" value="Accept" name="accept" > 
                      <input type="submit" value="Not Accept" name="notaccept" > 
                
                
            </td>
        </tr>

         <?php }?>
        
    </table>
        </div>
        </form>
    <?php } else { ?>
<h3>there is no request</h3> 
<?php } ?>
</div>

</div>
  </div>
     </div>  
</div>



<div id="Save" class="tabcontent">
  <?php 
  
  $UN= $_SESSION['user'];
  $Query = "SELECT * FROM saved WHERE User='$UN'";
  $result = mysqli_query($con,$Query);
  
  $SPost = array();
  $SNews = array();

while($rows=mysqli_fetch_assoc($result))
{    
    if($rows['Class']==='poster'){
           $id =$rows['No'];
           $query = "SELECT * FROM poster WHERE No='$id' LIMIT 1";
           $res = mysqli_query($con, $query);
           while($row= mysqli_fetch_assoc($res)){
           
            $SPost[$row['No']] = array(
                'no'=>$row['No'],
                'title' => $row['Title'],
                'img'=>$row['Img'],
                    'class'=>$rows['No']
                );
    }
    
           }
    elseif ($rows['Class']==='news'){
        $id =$rows['No'];
           $query = "SELECT * FROM news WHERE No='$id' LIMIT 1";
           $res = mysqli_query($con, $query);
           $cc=mysqli_num_rows($res);
            
            while($row= mysqli_fetch_assoc($res)){
            
              $SNews[$row['No']]= array(
                    'no'=>$row['No'],
                    'title'=>$row['Title'],
                    'img'=>$row['Img'],
                      'class'=>$rows['No']
                    
                ); 
            } 
    }
}

  ?>
<div class="content">
    <h3>List Item Saved</h3>
  <div class="page section">
    
    <?php 
    if (!empty($SPost) || !empty($SNews)) {


       ?>
    <form id="contact" method="POST" action="adminPro.php">
        <table> 
            
            <?php foreach($SPost as $i) {?>
                <tr>
                    <th>
                        <input type="radio" name="no" value="<?php echo $i['no']; ?>"/>
                        <input type="hidden" name="class" value="poster">
                    </th>
                    <td>
                        <a href="Posters.php?No=<?php echo  $i['no']; ?>">
                        <img width="100" height="100" src="<?php echo $i['img']; ?>"/><br>
                        <label><?php echo $i['title']; ?></label></a>
                    </td>
                </tr>
            <?php }  
                 foreach($SNews as $i) {?>
                <tr>
                    <th>
                        <input type="radio" name="no" id="item" value="<?php echo $i['no']; ?>"/>
                        <input type="hidden" name="class" value="news">
                        
                    </th>
                    <td>
                        <a href="News.php?No=<?php echo  $i['no']; ?>">
                        <img width="100" height="100" src="<?php echo $i['img']; ?>"/><br>
                        <label><?php echo $i['title']; ?></label></a>
                    </td>
                </tr>
            <?php } ?> 
                
                
        </table>
        <input type="submit" name="deletesaved" id="delete" value="Delete">
    </form>  
    <?php }  else {?>
    <h3>there is no saved item</h3> 
     <?php }?>
   </div>
</div>
</div>
  

<div id="modifiyclub" class="tabcontent">
  <?php  
  $uname=$_SESSION['user'];
  $query="SELECT * FROM clubs";
    $result= mysqli_query($con, $query);
    $Club= array();
    
    if($result){
        while ($row= mysqli_fetch_assoc($result)){
            
            $Club[$row['No']] = array(
                    'no'=>$row['No'],
                    'name' => $row['Name'],
                    'img'=>$row['Img'],
                    );

        }
    }
    
    if(!empty($Club)){
  ?>
  <div id="content">
        <div class="page shirts section">
            <div class="wrapper">
            <h3>Club</h3>

                <ul class="products">
                    <?php foreach($Club as $i) {?>
                        <li>
                            
                                <p><?php echo $i['name'];?></p>
                                <img width="50px" src="<?php echo $i['img']; ?>" alt="<?php echo $i['name']; ?>"/><br>
                                <a href="Clubinfo.php?No=<?php echo  $i['no']; ?>">View</a>
                                <a href="ModifyClub.php?No=<?php echo  $i['no']; ?>">Modify</a>
                                <a href="DeleteClub.php?No=<?php echo  $i['no']; ?>">Delete</a>
                            
                        </li>
                    <?php } ?>
                </ul>
            </div>    
        </div>
    <?php } else { ?>
<h3>there is no clubs</h3> 
<?php } ?>
</div>
    </div>
  
</div>


<div id="reqcreate" class="tabcontent">
    
   
     <div id="content">
         <div class="tables club">
<div class="page section">
    <h3>Request to Clubs</h3>
    
    <?php 

$Query = "SELECT * FROM clubrequest";


$result = mysqli_query($con,$Query);
$reqc = array();



while($row = mysqli_fetch_assoc($result))
{

$reqc[$row['No']]  = array(
            'no'=>$row['No'],
            'name' => $row['Name'],
            'about'=>$row['About'],
            'vis'=>$row['Vision'],
            'mis'=>$row['Mission'],
            'obj'=>$row['Objectives'],
            'prog'=>$row['Programs'],
            'req'=>$row['Requirements'],
            'adv'=>$row['Advantages'],
            'lead'=>$row['Leader'],
            'img'=>$row['Img'],
            );

}
$un=$row['Leader'];
$query="SELECT * FROM accounts WHERE Username='$un' LIMIT 1";
                $result= mysqli_query($con, $query);
                
                $row= mysqli_fetch_array($result);
                
                
                //$db_fname=$row['Username'];
                $db_email=$row['Email'];

                
    if(!empty($reqc)){ ?>
    <form id="contact" name="reqc" method="POST" action="adminPro.php" >
        <div class="tables" >
           
    <table  >
        <tr>
            
            <th>
                <label for="uid">Leader</label>
            </th>
             <th>
                <label for="image">Email</label>
            </th>
            <th>
                <label for="uid">Name</label>
            </th>
            <th>
                <label for="uid">About</label>
            </th>
            <th>
                <label for="uid">Vision</label>
            </th>
            <th>
                 <label for="uid">Mission</label>
            </th>
            <th>
               <label for="uid">Objectives</label>
            </th>
            <th>
                 <label for="pwd">Club Programs</label>
            </th>
            <th>
                <label for="uid">Requirements</label>
            </th>
            <th>
                 <label for="uid">Advantages</label>
            </th>
            <th>
                <label for="image">Upload Image</label>
            </th>
           
            <th>
                <label for="no">Status</label>
            </th>
        </tr>
    
  
       
          <?php   foreach ($reqc as $i){ ?>
        <tr>
            
            <td>
               <label><?php echo $i['lead'] ?></label>
            </td>
            <td>
                <a href="mailto:<?php echo $db_email ?>"> <?php echo $db_email ?></a>  
            </td>
            <td>
             <label><?php echo $i['name'] ?></label>
            </td>
            <td>
             <label><?php echo $i['about'] ?></label>
            </td>
            <td>
               <label><?php echo $i['vis'] ?></label>
            </td>
            <td>
             <label><?php echo $i['mis'] ?></label>
            </td>
            <td>
             <label><?php echo $i['obj'] ?></label>
            </td>        
            <td>
             <label><?php echo $i['prog'] ?></label>
            </td>
            <td>
               <label><?php echo $i['req'] ?></label>
            </td>
            <td>
             <label><?php echo $i['adv'] ?></label>             
            </td>
            <td>
             <img width="100" height="100" src="<?php echo $club['img']; ?>"/>
            </td>
            
            <td>
                
                      <input type="hidden" name="no" value="<?php echo $i['no'] ?>" >
                      <input type="submit" value="Accept" name="acceptclub" > 
                      <input type="submit" value="Not Accept" name="notacceptclub" > 
                
                
            </td>
        </tr>

         <?php }?>
        
    </table>
        </div>
        </form>
    <?php } else { ?>
<h3>there is no request</h3> 
<?php } ?>
</div>

</div>
  </div>
     </div>  
</div>



 </body>
    <?php include './Footer.php'; ?>
</html>