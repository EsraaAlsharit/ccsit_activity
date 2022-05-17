<!DOCTYPE html>
<html>
<head>
    <?php 
    use PHPMailer\PHPMailer\PHPMailer;
        require_once 'PHPMailer/PHPMailer.php';
        require_once 'PHPMailer/SMTP.php';
        require_once 'PHPMailer/Exception.php';
    $title = "Create Club";
    
    
        include 'Header.php';
        
    if(!isset($_SESSION['user'])){
        header('Location: Tojoin.php');           
    }
        
    if(isset($_POST['CreateClube'])){
            
        $name = $_POST['Name'];
        $about = $_POST['about'];
        $vis = $_POST['vis'];
        $mis = $_POST['mis'];
        $obj = $_POST['obj'];
        $prog = $_POST['prog'];
        $adv = $_POST['adv'];
        $req = $_POST['req'];

        if(!empty($_FILES['image']['name'])){

            $filename = $_FILES['image']['name'];
            $tmp  = $_FILES['image']['tmp_name'];
            $size = $_FILES['image']['size'];
            $error = $_FILES['image']['error'];
            



                //STEP 1: Construct the Destination Path
            $path = "img/clubs/";
            $path = $path.basename($filename);

            //CHECK FILE TYPE FROM EXTENSION
            $accepted = array('png','jpg','jpeg','gif');
            $ext_array = explode(".", $path);
            $extension = end($ext_array);
            
            $result = in_array($extension,$accepted);

            //STEP 2: CHECK 3 FACTORS: SIZE, TYPE and ERROR
            if($size <= 500000 && ($result==1) && ($error==0)){

                $out = move_uploaded_file($tmp, $path);        

                if($out==1){
                    
                
                    $athor=$_SESSION['user'];
               // $query = "INSERT INTO clubs( Name, About, Vision, Mission ,Objective, Programs , Requiremenrs , Advantages, Img, Leader) VALUES ('$name', '$about' , '$vis' , '$mis' , '$obj', '$prog' , '$req','$adv' , '$path', '$athor' )";
                  
                    if($athor!='admin'){
                        $query="SELECT * FROM accounts WHERE Username='$athor' LIMIT 1";
                        $result= mysqli_query($con, $query);
                        if($result==1){ 
                            $row= mysqli_fetch_array($result);
                            $db_fname=$row['Fname'];
                            $db_email=$row['Email'];
                            $query = "INSERT INTO clubrequest( Name, About, Vision, Mission ,Objectives , Programs , Requirements , Advantages, Img, Leader) VALUES ('$name', '$about' , '$vis' , '$mis' , '$obj', '$prog' , '$req','$adv' , '$path', '$athor' )";
                            
                            $result = mysqli_query($con, $query);
                                if($result){
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
                                    $bodyContent .= '<p>This is email to let you know we had your request to join the club and the admin will handel your order</p>';
                                    $mail->Subject = 'Email from CCSIT Activity suppuort system';
                                    $mail->Body    = $bodyContent;
                                    $mail->send();
                            
                            
                                    $status = "done";
                                
                                }
                                else{//table problem
                                    $status = "notdone";
                                }
                        }
                        else{//user problem
                            $status = "notdone";
                        }
                    }//user
                    else {
                        $query = "INSERT INTO clubs( Name, About, Vision, Mission ,Objectives , Programs , Requirements , Advantages, Img, Leader) VALUES ('$name', '$about' , '$vis' , '$mis' , '$obj', '$prog' , '$req','$adv' , '$path ', '$athor' )";
                        
                
                        $result = mysqli_query($con, $query);
                        if($result){
                            $status = "done";
                        }
                        else {
                            $status = "notdone";
                        }
                    }
                    
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
        }//with imge        
        else{

            $athor=$_SESSION['user'];
            
            if($athor!='admin'){

                $query="SELECT * FROM accounts WHERE Username='$athor' LIMIT 1";
                $result= mysqli_query($con, $query);
                if($result){ 
                    $row= mysqli_fetch_array($result);


                    $db_fname=$row['Fname'];
                    $db_email=$row['Email'];

                    $query = "INSERT INTO clubrequest( Name, About, Vision, Mission ,Objectives , Programs , Requirements , Advantages, Img, Leader) VALUES ('$name', '$about' , '$vis' , '$mis' , '$obj', '$prog' , '$req','$adv' , ' ', '$athor' )";

                    $result = mysqli_query($con, $query);
                    if($result){
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
                        $bodyContent .= '<p>This is email to let you know we had your request to join the club and the admin will handel your order</p>';            
                        $mail->Subject = 'Email from CCSIT Activity suppuort system';
                        $mail->Body    = $bodyContent;
                        $mail->send();

                        $status = "done";
                    }
                    else{
                        $status = "notdone";
                    }
                }
                else {
                    $status = "notdone";
                }
            
            }//user
            else{
                $query = "INSERT INTO clubs( Name, About, Vision, Mission ,Objectives , Programs , Requirements , Advantages, Img, Leader) VALUES ('$name', '$about' , '$vis' , '$mis' , '$obj', '$prog' , '$req','$adv' , ' ', '$athor' )";
                
                $result = mysqli_query($con, $query);
                if($result){
                    $status = "done";
                }
                else {
                    $status = "notdone";
                }
                
            }
   
        }
header("Location: CreateClub.php?status=$status");
    }
       
    
    ?>
    
</head>

<body>

<div id="content">
  <div class="page section">
    <h1>Create Club</h1>
    
     <?php if(isset($_GET['status']) and $_GET['status']==="notdone") { ?>          
          <p class="login-error">Please make sure you enter at least the name</p>
      <?php }  if (isset($_GET['status'])&& $_GET['status']==='done'){?>
    <script> alert('process done successfully' )</script><?php } ?>
    
    <form name="CreateClub" id="CreateClub" method="POST" action="CreateClub.php" enctype="multipart/form-data" onsubmit=" return validate_clubs();">      
      <table>
          <tr>
               <th>
                    <label for="uid">Name</label>
               </th>
               <td>
                    <input type="text" name="Name" id="Name">
                    <span class="error" id="name" style="visibility: hidden">* Required </span>
                    
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="uid">About</label>
               </th>
               <td>
                     <textarea name="about"  id="about" cols="50" rows="8" id="des"></textarea>
                    <span class="error" id="About" style="visibility: hidden">* Required </span>
                    
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="uid">Vision</label>
               </th>
               <td>
                     <textarea name="vis" cols="50" rows="8" id="des"></textarea>
                    
               </td>
          </tr>
          
          
          <tr>
               <th>
                    <label for="uid">Mission</label>
               </th>
               <td>
                     <textarea name="mis" cols="50" rows="8" ></textarea>
                   
               </td>
          </tr>
          

          <tr>
               <th>
                    <label for="uid">Objectives</label>
               </th>
               <td>
                    <textarea name="obj" cols="50" rows="8" id="des"></textarea>
                    
               </td>
          </tr>
                   
          
          <tr>
               <th>
                     <label for="pwd">Club Programs</label>
               </th>
               <td>
                       <textarea name="prog" cols="50" rows="8" id="des"></textarea>
                      
                      
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="uid">Requirements</label>
               </th>
               <td>
                    <textarea name="req" cols="50" rows="8" id="des"></textarea>
                   
                    
               </td>
          </tr>
            <tr>
               <th>
                    <label for="uid">Advantages</label>
               </th>
               <td>
                    <textarea name="adv" cols="50" rows="8" id="des"></textarea>
                   
                    
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
         

        <input type="submit" value="Send Create Request" name="CreateClube" >
    </form>
  </div>
</div>
    
</body>
<?php include './Footer.php'; ?>
</html>