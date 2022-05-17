<?php


$title = "modefy-account";
include 'Header.php';


if(!isset($_SESSION['user'])){
    header("Location: error.php");
}
if(isset($_GET['user'])) //107
{

    $id = $_GET['user'];
    $query = "SELECT * FROM accounts WHERE Username='$id'";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result))
    {

        $accounts = array(
                    'ID' => $row['ID'],
                    'Fname'=>$row['Fname'],
                    'Lname'=>$row['Lname'],
            'passsword'=>$row['Pass'],
            'major'=>$row['Magor'],
            'level'=>$row['Level'],
            'username'=>$row['Username'],
            'email'=>$row['Email'],
                    );

    }
}

if(isset($_POST['update']))
{
    $username=$_POST['username'];
            $Fname= $_POST['Fn'];
            $Lname= $_POST['Ln'];
            $ID= $_POST['id'];
            $Em= $_POST['Em'];
            $pass=$_POST['pwd'];
            $mr=$_POST['magor'];
            $lv=$_POST['level'];
   
                   
            $query = "UPDATE accounts SET Fname='$Fname', Lname='$Lname', Pass= '$pass', Magor= '$mr', Level= '$lv' , Email='$Em' WHERE Username='$username'";  
       
        
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
                 

        header("Location: userPro.php?status=$status");
}



?>

<div id="content">
    
   
   <div class="page section">
    <h1>Update account</h1>
   
   <?php if(isset($_GET['status']) && $_GET['status']==="done") { ?>  
    <p>account updated successfully in the Database</p>
    <?php }if(isset($_GET['status']) && $_GET['status']==="notdone") { ?>
    <p>Sorry your account was not updated</p>
    <?php }  ?>
   
    <form name="modify" method="POST" action="Modify.php" >

        <table>
          <tr>
               <th>
                    <label for="uid">Username</label>
               </th>
               <td>
                   <input name="username" type="text" value="<?php echo $accounts['username'] ?>" readonly >
                    <span class="error" id="user" style="visibility: hidden">* Required </span>
                    
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="uid">Frist Name</label>
               </th>
               <td>
                    <input type="text" name="Fn" value="<?php echo $accounts['Fname'] ?>" >
                    <span class="error" id="fname" style="visibility: hidden">* Required </span>
                    
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="uid">Last Name</label>
               </th>
               <td>
                    <input type="text" name="Ln"  value="<?php echo $accounts['Lname'] ?>">
                    <span class="error" id="lname" style="visibility: hidden">* Required </span>
               </td>
          </tr>
          
          
          <tr>
               <th>
                    <label for="uid">ID</label>
               </th>
               <td>
                   <input type="text" name="id" value="<?php echo $accounts['ID'] ?>" readonly>
                   <span class="error" id="id" style="visibility: hidden">* Required </span>
               </td>
          </tr>
          

          <tr>
               <th>
                    <label for="uid">Email</label>
               </th>
               <td>
                   <input type="text" name="Em"  placeholder="examaple@kfu.edu.sa" value="<?php echo $accounts['email'] ?>">
                    <span class="error" id="email" style="visibility: hidden">* Required </span>
               </td>
          </tr>
                   
          
          <tr>
               <th>
                     <label for="pwd">Password</label>
               </th>
               <td>
                   <input type="text" name="pwd" value="<?php echo $accounts['passsword'] ?>">
                      <span class="error" id="epwd" style="visibility: hidden">* Required </span>
                      
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="uid">Acadimac Levels</label>
               </th>
               <td>
                   




                    <select name="level"required >
                        <option value=1 <?php if( '1' == $accounts['level'] ){ ?> selected <?php } ?>>Level 1</option>
                        <option value=2 <?php if( '2' == $accounts['level'] ){ ?> selected <?php } ?>>Level 2</option>
                        <option value=3 <?php if( '3' == $accounts['level'] ){ ?> selected <?php } ?>>Level 3</option>
                        <option value=4 <?php if( '4' == $accounts['level'] ){ ?> selected <?php } ?>>Level 4</option>
                        <option value=5 <?php if( '5' == $accounts['level'] ){ ?> selected <?php } ?>>Level 5</option>
                        <option value=6 <?php if( '6' == $accounts['level'] ){ ?> selected <?php } ?>>Level 6</option>
                        <option value=7 <?php if( '7' == $accounts['level'] ){ ?> selected <?php } ?>>Level 7</option>
                        <option value=8 <?php if( '8' == $accounts['level'] ){ ?> selected <?php } ?>>Level 8</option>
                     
                   </select>
                   <span class="error" id="lv" style="visibility: hidden">* Required </span>
                    
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="magor">Magor</label>
               </th>
               <td>
                    <select name="magor" >
                        <option value="General" <?php if( 'General' == $accounts['major'] ){ ?> selected <?php } ?> >General</option>
                        <option value="CS" <?php if( 'CS' == $accounts['major'] ){ ?> selected <?php } ?> >CS</option>
                        <option value="IS" <?php if( 'IS' == $accounts['major'] ){ ?> selected <?php } ?> >IS</option>
                        <option value="CN" <?php if( 'CN' == $accounts['major'] ){ ?> selected <?php } ?> >CN</option>
                   </select>
                   <span class="error" id="mr" style="visibility: hidden">* Required </span>
                    
               </td>
          </tr>
          
          
          </table>
         

        <input type="submit" value="Update" name="update" >
    </form>
    </div>
</div>

<?php include 'footer.php'; ?>