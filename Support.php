<html>

    <head>
       

        <?php   use PHPMailer\PHPMailer\PHPMailer;
        require_once 'PHPMailer/PHPMailer.php';
        require_once 'PHPMailer/SMTP.php';
        require_once 'PHPMailer/Exception.php';
        $title="Support" ;
        include './Header.php';
        
        
        if(isset($_POST['submit'])){
            
           
            $Em= $_POST['email'];
            $Sub=$_POST['sub'];
            $Des=$_POST['des'];
            


$mail = new PHPMailer;

//$mail->IsSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'ccsit.kfu.activity@gmail.com';          // SMTP username
$mail->Password = 'ccsit2019'; // SMTP password
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = /*'587';*/'465';                          // TCP port to connect to

$mail->setFrom($Em , 'CCSIT Activity');
$mail->addAddress( $Em );   // Add a recipient


$mail->IsHTML(true);  // Set email format to HTML
$bodyContent = '<h1>thank you for contacting us </h1>';
$bodyContent .= '<p>This is email to let you know we had your massage and we will contact you as soon as possible</p>';
$bodyContent .= '<h4>content of the message</h4>';
$bodyContent.= '<div style="border: 2px solid #dedede; background-color: #f1f1f1; border-radius: 5px; padding: 10px;
  margin: 10px 0;">
    <p><b>Subject : </b>'. $Sub.'</p><br>
  <p> <b>Description : </b>'. $Des.'</p>
</div>';

$mail->Subject = 'Email from CCSIT Activity suppuort system';
$mail->Body    = $bodyContent;

$query = "INSERT INTO problem (Email,Subject,Description) VALUES ('$Em', '$Sub', '$Des')";
             
$result = mysqli_query($con, $query);


if(!$mail->send() && $result==1) {
    //header('Location:Support.php?status=done');
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Check your email for further  details';
    //header('Location: Support.php?status=notdone');
}

            
   
        }
        
         if(isset($_GET['status']) && $_GET['status']==="done"){?>
<script> alert('the process done successfully' )</script>
<?php } 

        ?>

<title> CCSIT ACTIVITY - <?php echo $title; ?> </title>
    <link rel="stylesheet" href="css/style_1.css">
<script type="text/javascript" src="js/validation.js"></script>

</head>

 <body>
<div id="content">
  <div class="page section">
    <h1>Submit your problem</h1>

    <form id="support" name="support" method="POST" action="Support.php" onsubmit="return validate_support();">

      <?php if(isset($_GET['status']) and $_GET['status']==="notdone") { ?>          
          <p>Please Try Again</p>
      <?php } ?> 

      <table>
          <tr>
               <th>
                    <label for="uid">Your email address</label>
               </th>
               <td>
                    <input type="email" name="email" >
                    <span class="error" id="em" style="visibility: hidden">* Required </span>
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="uid">Subject</label>
               </th>
               <td>
                    <input type="text" name="sub" >
                    <span class="error" id="sub" style="visibility: hidden">* Required </span>
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="uid">Description</label>
               </th>
               <td>
                   <textarea rows="15" cols="50" name="des" ></textarea>
                    <span class="error" id="des" style="visibility: hidden">* Required </span>
               </td>
          </tr>
          
          </table>
         

        <input type="submit" value="Submit" name="submit" >
    </form>
  </div>
</div>
 </body>
 <?php include 'Footer.php';?>
</html>