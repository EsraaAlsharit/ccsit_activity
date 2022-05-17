<!DOCTYPE html>
<html>
<head>
    <?php 
    use PHPMailer\PHPMailer\PHPMailer;
        require_once 'PHPMailer/PHPMailer.php';
        require_once 'PHPMailer/SMTP.php';
        require_once 'PHPMailer/Exception.php';
    $title = "SignUp";
    
    
        include './Header.php';

        if(isset($_POST['Signup'])){
            
            $username=$_POST['username'];
            $Fname= $_POST['Fn'];
            $Lname= $_POST['Ln'];
            $ID= $_POST['id'];
            $Em= $_POST['Em'];
            $pass=$_POST['pwd'];
            $mr=$_POST['magor'];
            $lv=$_POST['level'];
            $le=$_POST['confirmpassword'];
          

            $query = "INSERT INTO accounts(Username,ID,Fname,Lname,Email,Pass,Magor,Level) VALUES ('$username','$ID', '$Fname', '$Lname', '$Em', '$pass', '$mr', '$lv')";

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

            $mail->setFrom($Em , 'Request to join');
            $mail->addAddress( $Em );   // Add a recipient


            $mail->IsHTML(true);  // Set email format to HTML
            $bodyContent = '<h1>Dear, '.$Fname.'</h1>';
            $bodyContent .= '<h3>welcome in CCSIT ACTIVITY website i hope you enjoy with us.</h3>';

            $mail->Subject = 'Email from CCSIT Activity suppuort system';
            $mail->Body    = $bodyContent;
            $mail->send();
            
                header('Location: index.php?status=done');
            }
         else {

                header('Location: SignUp.php?status=notdone');

            }
        }
       
    
    ?>
    
</head>

<body>

<div id="content">
  <div class="page section">
    <h1>Sign Up</h1>

    <form name="SignUp" method="POST" action="SignUp.php" onsubmit=" return validate_contact();">

      <?php if(isset($_GET['status']) and $_GET['status']==="notdone") { ?>          
          <p class="login-error">Please make sure of your informations</p>
      <?php } ?> 

      <table>
          <tr>
               <th>
                    <label for="uid">Username</label>
               </th>
               <td>
                    <input type="text" name="username" >
                    <span class="error" id="user" style="visibility: hidden">* Required </span>
                    
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="uid">Frist Name</label>
               </th>
               <td>
                    <input type="text" name="Fn" >
                    <span class="error" id="fname" style="visibility: hidden">* Required </span>
                    
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="uid">Last Name</label>
               </th>
               <td>
                    <input type="text" name="Ln" >
                    <span class="error" id="lname" style="visibility: hidden">* Required </span>
               </td>
          </tr>
          
          
          <tr>
               <th>
                    <label for="uid">ID</label>
               </th>
               <td>
                    <input type="text" name="id" >
                   <span class="error" id="id" style="visibility: hidden">* Required </span>
               </td>
          </tr>
          

          <tr>
               <th>
                    <label for="uid">Email</label>
               </th>
               <td>
                   <input type="text" name="Em"  placeholder="examaple@kfu.edu.sa">
                    <span class="error" id="email" style="visibility: hidden">* Required </span>
               </td>
          </tr>
                   
          
          <tr>
               <th>
                     <label for="pwd">Password</label>
               </th>
               <td>
                      <input type="password" name="pwd" >
                      <span class="error" id="epwd" style="visibility: hidden">* Required </span>
                      
               </td>
          </tr>
          
          
          <tr>
               <th>
                    <label for="uid">Acadimac Levels</label>
               </th>
               <td>
                    <select name="level"required >
                        <option value=1>Level 1</option>
                        <option value=2>Level 2</option>
                        <option value=3>Level 3</option>
                        <option value=4>Level 4</option>
                        <option value=5>Level 5</option>
                        <option value=6>Level 6</option>
                        <option value=7>Level 7</option>
                        <option value=8>Level 8</option>
                   </select>
                   <span class="error" id="lv" style="visibility: hidden">* Required </span>
                    
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="magor">Magor</label>
               </th>
               <td>
                    <select name="magor"required >
                        <option value="General" selected>General</option>
                        <option value="CS">CS</option>
                        <option value="IS">IS</option>
                        <option value="CN">CN</option>
                   </select>
                   <span class="error" id="mr" style="visibility: hidden">* Required </span>
                    
               </td>
          </tr>
          
          
          </table>
         

        <input type="submit" value="Create account " name="Signup" >
    </form>
  </div>
</div>
    
</body>
<?php include './Footer.php'; ?>
</html>