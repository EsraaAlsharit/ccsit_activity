
    <?php use PHPMailer\PHPMailer\PHPMailer;
        require_once 'PHPMailer/PHPMailer.php';
        require_once 'PHPMailer/SMTP.php';
        require_once 'PHPMailer/Exception.php';
    include 'DB.php';
    session_start();
    
    $U=$_SESSION['user'];
    if(!isset($_SESSION['user'])){
        header('Location: Tojoin.php');
    }
    
    elseif($U=='admin') {
        header('Location: clubs.php');
    }
    
    else{
 
    if(isset($_GET['request'])){
       $C=$_GET['request'];
       
       $query="SELECT Leader FROM clubs WHERE Name='$C' LIMIT 1";
      
        
         $result= mysqli_query($con, $query);
         $row= mysqli_fetch_array($result);
        $Leader =$row['Leader'];
        
        if($result){
            
            $uname=$_SESSION['user'];
            $query="SELECT * FROM accounts WHERE Username='$uname' LIMIT 1";
        $result= mysqli_query($con, $query);
        if($result){
            
            
                $row= mysqli_fetch_array($result);
                
                $db_uname=$row['Username'];
                $db_fname=$row['Fname'];
                $db_lname=$row['Lname'];
                $db_email=$row['Email'];
                $db_id=$row['ID'];
                $db_magor=$row['Magor'];
                $db_level=$row['Level'];
                
                $query = "INSERT INTO request(Username,ID,Fname,Lname,Email,Magor,Level,Club,Admin) VALUES ('$db_uname','$db_id', '$db_fname', '$db_lname', '$db_email', '$db_magor', '$db_level', '$C', '$Leader' )";
                
                $result = mysqli_query($con, $query);
                
            if($result==1){
                
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
            $bodyContent .= '<p>This is email to let you know we had your request to join the club and the leader for the club will handel your order</p>';
            

            $mail->Subject = 'Email from CCSIT Activity suppuort system';
            $mail->Body    = $bodyContent;
            $mail->send();
            
                 header("Location: ExitClubs.php?state=done"); 
            } 
            else {
                header("Location: ExitClubs.php?state=notdone");
            }
        }
        else{
        header("Location: ExitClubs.php?state=notdone");
        }
    }
    else {
        header("Location: ExitClubs.php?state=notdone");
    }
    }
    
    
    
    }
    
    ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
 

