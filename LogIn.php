<!DOCTYPE html>
<html>
<head>
    <?php 

$title = "Login";

include './Header.php';
?>
</head>

<body>
<?php
 

if(isset($_POST['Login']))
{
    $uname = $_POST['uid']; 
    $pwd = ($_POST['pwd']);   

    $query = "SELECT * FROM admins WHERE username='$uname' AND password='$pwd'";
    $result = mysqli_query($con, $query);
    
    if($result)
    {
            if(mysqli_num_rows($result)==1)//if true 1
            {
                $_SESSION['user'] = $uname;
                //profile admin
               // $state=1;
                header("Location: index.php?status=valid");
                //header('Location: login.php?status=valid');
            }
            else
            {
                $uname= $_POST['uid'];
                  $pwd=$_POST['pwd'];

                $sql="SELECT * FROM accounts WHERE Username='$uname' LIMIT 1";
                $Q= mysqli_query($con, $sql);
                $row= mysqli_fetch_array($Q);
                $db_name=$row['Username'];
                $db_pass=$row['Pass'];

                if($pwd==$db_pass){
                $_SESSION['user']=$db_name;
               // $state=1;
                header('Location: index.php');
                
                }
                else {  
                   // $state=0;
                    header('Location: LogIn.php?status=invalid');


                }


            }
    }
        
 }
 

 

?>

<div id="content">
  <div class="page section">
    <h1>Login</h1>

    <form id="login" name="login" method="POST" action="LogIn.php" onsubmit="return validate_login();">

      <?php if(isset($_GET['status']) and $_GET['status']==="invalid") { ?>          
          <p class="login-error">Username or password wrong. Please Try Again</p>
      <?php } ?> 

      <table>
          <tr>
               <th>
                    <label for="uid">Username</label>
               </th>
               <td>
                    <input type="text" name="uid" id="uid">
                    <span class="error" id="ename" style="visibility: hidden">* Required </span>
               </td>
          </tr>
          <tr>
               <th>
                     <label for="pwd">Password</label>
               </th>
               <td>
                      <input type="password" name="pwd" id="pwd">
                      <span class="error" id="epwd" style="visibility: hidden">* Required </span>
               </td>
          </tr>
          </table>
         

        <input type="submit" value="Login" name="Login" id="submit">
        <a href="password.php" style="color: blue; text-align: center; text-decoration: underline;" >forgot the password ?</a>
    </form>
  </div>
</div>
    
</body>
<?php include './Footer.php'; ?>
</html>