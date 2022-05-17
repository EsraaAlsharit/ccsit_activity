<!DOCTYPE html>
<html>
<head>
    <?php use PHPMailer\PHPMailer\PHPMailer;
        require_once 'PHPMailer/PHPMailer.php';
        require_once 'PHPMailer/SMTP.php';
        require_once 'PHPMailer/Exception.php';

$title = "acounnt";

include 'Header.php';

 if(isset($_GET['status']) && $_GET['status']==="done") { ?>  
    <script> alert('process done successfully' )</script>
    
    <?php } if(isset($_GET['status']) && $_GET['status']==="notdone") { ?>
    <script> alert('this email do have account' )</script>
    
    <?php } ?>

    
</head>

<body>

<div id="content">
  <div class="page section">
    <h1>forgot password</h1>
  
          
          <?php
          
          if(isset($_POST['cheak'])){
              
              $Em= $_POST['email'];
              $pass=$_POST['pwd'];
              $code= $_POST['code'];
              
              $sql="SELECT * FROM code WHERE Email='$Em' AND Code='$code' LIMIT 1";
              $res= mysqli_query($con, $sql);
              
              if(mysqli_num_rows($res)!=0){
                  
                  
                  $sql="SELECT * FROM accounts WHERE Email='$Em' LIMIT 1";
                  $result= mysqli_query($con, $sql);
                  if($result){
                      
                    $row= mysqli_fetch_array($result);
                    $db_name=$row['Username'];
                    
                     $query = "UPDATE accounts SET Pass= '$pass' WHERE Username='$db_name'"; 
                      $result= mysqli_query($con, $query);
                      
                      if($result){
                         
                          $query="DELETE FROM code WHERE Email= '$Em' ";
                          $result= mysqli_query($con, $query);
                          if($result){
                             header('Location: LogIn.php?status=done'); 
                            }
                           
                        }

                    }
                }
 else { ?>
    $query="DELETE FROM code WHERE Email= '$Em' ";
    <script> alert('the code uncorrect')</script>
 <?php    
          }
          
          
 } 
              
              
       
          
          if(isset($_GET['submit'])){
              $Em= $_GET['email'];
              $randomNumber = rand(1000,9000); 
              
              $sql="SELECT Fname FROM accounts WHERE Email='$Em' LIMIT 1";
             // $result1 = mysqli_query($con, $query1);
              
              
              $res= mysqli_query($con, $sql);
              $db_Fname = mysqli_fetch_row($res)[0];
              if($db_Fname!=""){
                  
               
                
               
              $mail = new PHPMailer;

            //$mail->IsSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'ccsit.kfu.activity@gmail.com';          // SMTP username
            $mail->Password = 'ccsit2019'; // SMTP password
            $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = /*'587';*/'465';                          // TCP port to connect to

            $mail->setFrom($Em , 'forgot password');
            $mail->addAddress( $Em );   // Add a recipient


            $mail->IsHTML(true);  // Set email format to HTML
            $bodyContent = '<h1>Dear, '.$db_Fname.'</h1>';
            $bodyContent .= '<p>you ask for make new password.</p>';
            $bodyContent .= '<p>verification code : <b>'.$randomNumber.' </b> </p>';
            $mail->Subject = 'Email from CCSIT Activity suppuort system';
            $mail->Body    = $bodyContent;
              if($mail->send()){
                  $query = "INSERT INTO code(Email,Code) VALUES ( '$Em', '$randomNumber')";
                  $result = mysqli_query($con, $query);
                  
              }
              
              }
              
 else {
      header('Location: password.php?status=notdone'); 
     ?>
    
 <?php }
 
 

      
              ?>
          <form  method="POST" action="password.php" >

      <table>
          
          
          <tr>
               <th>
                    <label for="uid">Code</label>
               </th>
               <td>
                    <input type="text" name="code" id="uid">
                    <span class="error" id="ename" style="visibility: hidden">* Required </span>
               </td>
          </tr>
          <tr>
               <th>
                     <label for="pwd">New Password</label>
               </th>
               <td>
                   <input type="hidden" name="email" value="<?php echo $Em; ?>">
                      <input type="password" name="pwd" id="pwd">
                      <span class="error" id="epwd" style="visibility: hidden">* Required </span>
               </td>
              
          </tr>
          
          </table>
         

        <input type="submit" value="submit" name="cheak" >
        
       
    </form>
           <?php }
           else{?>
               <form  method="GET" action="password.php" >

      <table>
          
          
          <tr>
               <th>
                    <label for="uid">Email</label>
               </th>
               <td>
                    <input type="text" name="email" id="uid">
                    <span class="error" id="ename" style="visibility: hidden">* Required </span>
               </td>
          </tr>
          
          
          </table>
         

        <input type="submit" value="submit" name="submit" >
       
    </form>
          
           <?php }
?>
  </div>
</div>
    
</body>
<?php include 'Footer.php'; ?>
</html>