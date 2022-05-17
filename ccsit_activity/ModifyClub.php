<html>
<header>
    <?php 
    $title = "Update club";
    include 'Header.php';
    
    if(!isset($_SESSION['user']))
{
    header('Location: error.php');
}


if(isset($_GET['No'])){

    $id = $_GET['No'];
    $query = "SELECT * FROM clubs WHERE No='$id'";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result)){

        $club = array(
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
}



if(isset($_POST['update'])){
    
        $id = $_POST['no'];
        $name = $_POST['EName'];
        $about = $_POST['about'];
        $vis = $_POST['vis'];
        $mis = $_POST['mis'];
        $obj = $_POST['obj'];
        $prog = $_POST['prog'];
        $adv = $_POST['adv'];
        $req = $_POST['req'];
        $leader=$_POST['lead'];

        //IF the user uploaded a new image
        $U=$_SESSION['user'];
        if(!empty($_FILES['image']['name']))
        {
             
            $filename = $_FILES['image']['name'];
            $tmp  = $_FILES['image']['tmp_name'];
            $size = $_FILES['image']['size'];
            $error = $_FILES['image']['error'];
            $type = $_FILES['image']['type'];

            

            //STEP 1: Construct the Destination Path
            $path = "img/clubs/";
            $path = $path.basename($filename);

            //CHECK FILE TYPE FROM EXTENSION
            $accepted = array('png','jpg','jpeg','gif');
            $ext_array = explode(".", $path);
            $extension = end($ext_array);
            
            $result = in_array($extension,$accepted);

            //STEP 2: CHECK 3 FACTORS: SIZE, TYPE and ERROR
            if($size <= 500000 && ($result==1) && ($error==0))
            {
                
                $out = move_uploaded_file($tmp, $path);        
                
                if($out==1)
                {
                    $query = "UPDATE clubs SET Name='$name', About='$about', Vision='$vis', Mission='$mis' ,Objectives='$obj', Programs='$prog', Requirements='$req', Advantages='$adv', Img='$path', Leader= '$leader' WHERE No=$id";
                      //$out=1;             
                }
            }
            else
            {
                
                if($U=='admin')
                header("Location: adminPro.php?status=notdone");
                else
                header("Location: userPro.php?status=notdone");
            }
        }
        else   //IF no new image is uploaded from the update form
        {
           
            $out = 1;
            $query = "UPDATE clubs SET Name='$name' , About='$about' , Vision='$vis' , Mission='$mis' , Objectives='$obj' , Programs='$prog' , Requirements='$req' , Advantages='$adv' , Leader='$leader' WHERE No=$id";
        
        }
        if($out==1)
        {
            
            $res = mysqli_query($con, $query);        

            //STEP 6: Check the result
            if($res==1)
            {
                if($U=='admin')
                header("Location: adminPro.php?status=done");
                else
                header("Location: userPro.php?status=done");
                
            }
            else
            {   if($U=='admin')
                header("Location: adminPro.php?status=notdone");
             else
                header("Location: userPro.php?status=notdone");
                
            }
        }
        else
        {
            if($U=='admin')
            header("Location: adminPro.php?status=notdone");
             else
                header("Location: userPro.php?status=notdone");
            
        } 
        
        
        }               


    ?>
</header>
<body>

<div id="content">
  <div class="page section">
    <h1>Create Club</h1>
    
     <?php if(isset($_GET['status']) and $_GET['status']==="notdone") { ?>          
          <p class="login-error">Please make sure you enter at least the name</p>
      <?php }  if (isset($_GET['status'])&& $_GET['status']==='done'){?>
    <script> alert('process done successfully' )</script><?php } ?>
    
    <form name="MCreateClub" id="MCreateClub" method="POST" action="ModifyClub.php" enctype="multipart/form-data" onsubmit=" return validate_MClubs();">      
      <table>
          <tr>
               <th>
                    <label for="uid">Name</label>
               </th>
               <td>
                   
                   <input type="text" name="EName" id="EName" value="<?php echo $club['name']; ?>">
                    <span class="error" id="name" style="visibility: hidden">* Required </span>
                    
               </td>
          </tr>
          <tr>
               <th>
                    <label for="uid">Leader</label>
               </th>
               <td>
                   <?php 
                   $c=$club['name'];
                   $query="SELECT * FROM member WHERE club='$c'";
    $result= mysqli_query($con, $query);
  
  while($row = mysqli_fetch_assoc($result))
{

$mem[$row['No']]= array(
    'user'=>$row['username'],
    'club'=>$row['club']);
                   

}
?>
                    <select name="lead" >
                <?php  foreach($mem as $i) {    ?>
                   
                        <option value="<?php echo $i['user']; ?>" <?php if( $i['user'] == $club['lead'] ){ ?> selected <?php } ?> ><?php echo $i['user']; ?></option>
            <?php } ?>
                   </select>
 
                  
                    <span class="error" id="lead" style="visibility: hidden">* Required </span>
                    
               </td>
          </tr>
          <tr>
               <th>
                    <label for="uid">About</label>
               </th>
               <td>
                     <textarea name="about"  id="about" cols="50" rows="8" id="des"><?php echo $club['about']; ?></textarea>
                    <span class="error" id="About" style="visibility: hidden">* Required </span>
                    
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="uid">Vision</label>
               </th>
               <td>
                     <textarea name="vis" cols="50" rows="8" id="des"><?php echo $club['vis']; ?></textarea>
                    
               </td>
          </tr>
          
          
          <tr>
               <th>
                    <label for="uid">Mission</label>
               </th>
               <td>
                     <textarea name="mis" cols="50" rows="8" ><?php echo $club['mis']; ?></textarea>
                   
               </td>
          </tr>
          

          <tr>
               <th>
                    <label for="uid">Objectives</label>
               </th>
               <td>
                    <textarea name="obj" cols="50" rows="8" id="des"><?php echo $club['obj']; ?></textarea>
                    
               </td>
          </tr>
                   
          
          <tr>
               <th>
                     <label for="pwd">Club Programs</label>
               </th>
               <td>
                       <textarea name="prog" cols="50" rows="8" id="des"><?php echo $club['prog']; ?></textarea>
                      
                      
               </td>
          </tr>
          
          <tr>
               <th>
                    <label for="uid">Requirements</label>
               </th>
               <td>
                    <textarea name="req" cols="50" rows="8" id="des"><?php echo $club['req']; ?></textarea>
                   
                    
               </td>
          </tr>
            <tr>
               <th>
                    <label for="uid">Advantages</label>
               </th>
               <td>
                    <textarea name="adv" cols="50" rows="8" id="des"><?php echo $club['adv']; ?></textarea>
                   
                    
               </td>
          </tr>
          <tr>
                <th>
                    <label for="image">Upload Image</label>
                </th>
                <td>
                    <img width="100" height="100" src="<?php echo $club['img']; ?>"/>
                                <input type="file" name="image" >
                                <input type="hidden" name="imageret" value="<?php echo $club['img'] ?>" > 
                                <span style="font-size: 0.6em; font-style: italic;">(Maximum 500 KB)</span>
                </td>
            </tr>
          </table>
         
        <input type="hidden" name="no" value="<?php echo $club['no']; ?>">
        <input type="submit" value="Update" name="update">
    </form>
  </div>
</div>
    
</body>
<?php include 'Footer.php'; ?>
</html>