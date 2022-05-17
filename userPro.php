<html>
    <head>
        
     <?php use PHPMailer\PHPMailer\PHPMailer;
        require_once 'PHPMailer/PHPMailer.php';
        require_once 'PHPMailer/SMTP.php';
        require_once 'PHPMailer/Exception.php';
     $title="user profile";
     
    include 'DB.php';
     include 'Header.php'; 
     
      if(!isset($_SESSION['user'])){
     header("Location: error.php");
      }
     if(isset($_SESSION['user']) && ($_SESSION['user']==="admin")){
     header("Location: adminPro.php");}
        
    if(isset($_POST['modify'])){
        header("Location: Modify.php?user=".$_SESSION['user']);
    }
        
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

        header("Location: userPro.php?status=$status");

    }
    //add poster
if(isset($_POST['accept'])){

        $No=$_POST['no'];
        $un=$_POST['user'];
        $club=$_POST['club'];
        $query="INSERT INTO member(username, club) VALUES ('$un', '$club' )";

        $result= mysqli_query($con, $query);
        

        if($result){
            $query= "DELETE FROM request WHERE No='$No'";

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
        $No=$_POST['no'];
        $un=$_POST['user'];
        $club=$_POST['club'];
        $query= "DELETE FROM request WHERE No='$No'";

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
    

if(isset($_POST['deletesaved'])){
       $No= $_POST['no'];
        $class=$_POST['class'];
        
        $query= "DELETE FROM saved WHERE No='$No' AND Class='$class'";
        $result= mysqli_query($con, $query);
        
        if ($result){
            header("Location: userPro.php?status=done");
        }
    }
        
    
       if(isset($_GET['status']) && $_GET['status']==="done") { ?>  
    <script> alert('process done successfully' )</script>
    
    <?php } if(isset($_GET['status']) && $_GET['status']==="notdone") { ?>
    <script> alert('Sorry process not done' )</script>
    
    <?php } ?>
        
        
        
    </head>
   <body>

<h1>Profile</h1>

<div class="tab" >
  <button class="tablinks" onclick="openTab(event, 'account')" id="defaultOpen">Your Account</button>
  <!--button class="tablinks" onclick="openTab(event, 'comm')">Comment</button-->
  <button class="tablinks" onclick="openTab(event, 'Save')">Saved</button>
  
  <?php
   $uname=$_SESSION['user'];
  $query="SELECT * FROM clubs WHERE Leader='$uname' LIMIT 1";
  $result= mysqli_query($con, $query);
  $row= mysqli_fetch_array($result);
  $dbname=$row['Leader'];
  if($dbname===$uname){ ?>
  <button class="tablinks" onclick="openTab(event, 'modifiyclub')">Club</button>
  <button class="tablinks" onclick="openTab(event, 'req')">Request</button>
   <?php } 
   
  $uname=$_SESSION['user'];
  $query="SELECT * FROM member WHERE Username='$uname' LIMIT 1";
  $result= mysqli_query($con, $query);
  $row= mysqli_fetch_array($result);
                $dbname=$row['username'];
  if($dbname===$uname){  ?>
  <button class="tablinks" onclick="openTab(event, 'post')">Poster</button>
  <button class="tablinks" onclick="openTab(event, 'add')">Add Poster</button>
  <!--button class="tablinks" onclick="window.open('Roomchat.php', '_blank'),openTab(event, 'mass')">Massage</button-->
  
  
  <?php } ?>
 
</div>

<div id="account" class="tabcontent ">
    
  <h3>Information</h3>
  <?php
  
    $find=$_SESSION['user'];
    $sql="SELECT * FROM accounts WHERE Username='$find' LIMIT 1";
                $Q= mysqli_query($con, $sql);
                $row= mysqli_fetch_array($Q);
              
    
  if(isset($_SESSION['user'],$_POST['delete']))
{
    header('Location: deleteuserself.php?Username='.$_SESSION['user']);
    
}


    
    ?>

  <form action="userPro.php" method="POST">
  <table>
        
        <tr> 
            <th><label for="uid">USERNAME:</label></th>
            <td>     <input type="text" name="accountu"  disabled value="<?php echo $row['Username']; ?>"></td>
        </tr> 
        
        <tr>
            <th> <label for="uid">EMAIL:</label></th>
            <td> <input type="text"  disabled value="<?php echo $row['Email']; ?>"></td>
        </tr>

         <tr> 
            <th><label for="uid">ID:</label></th>
            <td>     <input type="text" disabled id="uid" value="<?php echo $row['ID']; ?>"></td>
        </tr>
        
        <tr> 
            <th><label for="uid">FIRST NAME:</label></th>
            <td>   <input type="text" disabled value="<?php echo $row['Fname']; ?>"> </td>
        </tr>            
        <tr> 
            <th> <label for="uid">LAST NAME:</label></th>
            <td> <input type="text" disabled value="<?php echo $row['Lname']; ?>"></td>
        </tr>
  
        
        <tr> <th>  <label for="uid">MAGOR:</label></th>
        <td>  <input type="text" disabled value="<?php echo $row['Magor']; ?>"></td>
        </tr>
        
        <tr> 
            <th> <label for="uid">LEVEL:</label></th>
            <td><input type="text" disabled value="<?php echo $row['Level']; ?>"></td>
        </tr>

    </table>
  
        <input type="submit" value="Modify Account" name="modify" ><br>
        <input type="submit" name="delete"  value="Delete Account">
</form>
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
  <div class="page section">
    <h3>List Item Saved</h3>
    <?php 
    if (!empty($SPost) || !empty($SNews)) {?>
    
    <form id="contact" method="POST" action="userPro.php">
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
            <?php } ?>   
                <?php foreach($SNews as $i) {?>
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
      <?php }
 else {?>
    <h3>there is no saved item</h3> 
     <?php }?>
   </div>
</div>
</div>

<div id="post" class="tabcontent">
  <h3>Poster You Share</h3>
  <?php 
    $uname=$_SESSION['user'];
    $query = "SELECT * FROM poster where Author='$uname'";


$result = mysqli_query($con,$query);
$Post = array();


while($row = mysqli_fetch_assoc($result)){

$Post[$row['No']] = array(
                    'no'=>$row['No'],
                    'title' => $row['Title'],
                    'des'=>$row['Description'],
                    'place'=>$row['Place'],
                    'img'=>$row['Img'],
                    'time'=>$row['Time'],
                    'aother'=>$row['Author'],
                    'date'=>$row['Date']
                    );

}
if (!empty($Post)){
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
<?php } else { ?>
      <h3>there is no poster</h3>
<?php }    ?>
         </div>
  
  
</div>

<!--div id="comm" class="tabcontent">
  <h3>Your Comments</h3>
   
 
</div-->
  


<div id="add" class="tabcontent">
  <div id="content">
<div class="breadcrumb">
<div class="page section">
    <h3>Create Poster</h3>
    
    <form  name="post" method="POST" action="userPro.php" enctype="multipart/form-data" onsubmit=" return validate_poster();">

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


<div id="req" class="tabcontent">
    
   
     <div id="content">
         <div class="tables ceas">
<div class="page section">
    <h3>Request to Join Club</h3>
    
    <?php 

$UN= $_SESSION['user'];
$Query = "SELECT * FROM request WHERE Admin='$UN' ";


$result = mysqli_query($con,$Query);
$req = array();


while($row = mysqli_fetch_assoc($result))
{

$req[$row['No']] = array(
        'no'=>$row['No'],
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
    <form id="contact" name="req" method="POST" action="userPro.php" >
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
                    <input type="hidden" name="no" value="<?php echo $i['no']; ?>"/>
                      <input type="submit" value="Accept" name="accept" > 
                      <input type="submit" value="Not Accept" name="notaccept" > 
               
                
            </td>
        </tr>

         <?php }?>
        
    </table>
        </div>
        </form>
    <?php }else {?>
    <h3>there is no request</h3> 
     <?php }?>

</div>
  </div>
     </div>  
</div>



<div id="mass" class="tabcontent">
  <h3>Massage</h3>


  <h3 style="text-align: center" >CHAT ROOM OPENED</h3>

</div>

<div id="modifiyclub" class="tabcontent">
  <?php  
  $uname=$_SESSION['user'];
  $query="SELECT * FROM clubs WHERE Leader='$uname' ";
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
    
       
    
  ?>
  <div id="content">
    <?php  if(!empty($Club)){ ?>
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
   <?php }  else {?>
    <h3>there is no club</h3> 
     <?php }?>
    </div>
  
</div>

 </body>
    <?php include 'Footer.php'; ?>
</html>