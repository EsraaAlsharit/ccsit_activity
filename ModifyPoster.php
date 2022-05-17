
<?php

$title = "Update poster";
include 'Header.php'; 


if(!isset($_SESSION['user']))
{
    header('Location: error.php');
}

if(isset($_GET['No'])) //107
{

    $id = $_GET['No'];
    $query = "SELECT * FROM poster WHERE No='$id'";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result))
{

$Post = array(
                    'no'=>$row['No'],
                    'title' => $row['Title'],
                    'des'=>$row['Description'],
                    'place'=>$row['Place'],
                    'img'=>$row['Img'],
                    'time'=>$row['Time'],
                    'aother'=>$row['Author'],
                    'date'=>$row['Date'],
                    'end'=>$row['DateEnd']
                    );

}

}



if(isset($_POST['update'])){
        $id = $_POST['no'];
        $title = $_POST['title'];
        $des = $_POST['des'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        $place = $_POST['Place'];
        $Edate = $_POST['edate'];

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
                    $query = "UPDATE poster SET Title='$title', Description='$des' , Place='$place' , Time='$time' , Date='$date' , DateEnd='$Edate',  img = '$path' WHERE No=$id";                  
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
            $query = "UPDATE poster SET Title='$title', Description='$des' , Place='$place' , Time='$time' , Date='$date', DateEnd='$Edate' WHERE No=$id";  
        }

        if($out==1)
        {
            //STEP 5: Run the Query
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
                
            }
        }
        else
        {
            if($U=='admin')
            header("Location: adminPro.php?status=notdone");
            
        }                

}

?>

<div id="content">
   
   <div class="page section">
    <h1>Update Poster</h1>
    
 
    
    <form id="update" name="update" method="POST" action="ModifyPoster.php" enctype="multipart/form-data">

                    <table>
                        <tr>
                            <th>
                                <label for="pid">Title</label>
                            </th>
                            <td>
                                <input type="hidden" name="no" value="<?php echo $Post['no']; ?>">
                                <input type="text" name="title"  value="<?php echo $Post['title']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="name">Description</label>
                            </th>
                            <td>
                                <textarea name="des" rows="15" cols="10" ><?php echo $Post['des']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="price">Place</label>
                            </th>
                            <td>
                                <input type="text" name="Place" value="<?php echo $Post['place']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label >Time</label>
                            </th>
                            <td>
                                <input type="time" name="time" value="<?php echo $Post['time']; ?>">
                            </td>
                        </tr>
                        
                                                
                        <tr>
                            <th>
                                <label for="price">Date</label>
                            </th>
                            <td>
                                <input type="date" name="date" value="<?php echo $Post['date']; ?>">
                                
                            </td>
                        </tr>
                        
                         <tr>
                            <th>
                                <label for="price">End Date</label>
                            </th>
                            <td>
                                <input type="date" name="edate" id="date" value="<?php echo $Post['end']; ?>">
                                
                            </td>
                        </tr>  
                        
                        <tr>
                            <th>
                                <label for="image">Upload Image</label>
                            </th>
                            <td>
                                <img width="100" height="100" src="<?php echo $Post['img']; ?>"/>
                                <input type="file" name="image" >
                                <input type="hidden" name="imageret" value="<?php echo $Post['img'] ?>" > 
                                <span style="font-size: 0.6em; font-style: italic;">(Maximum 500 KB)</span>
                            </td>
                        </tr>
                                            
                    </table>
                    <input type="submit" value="Update" name="update">

                </form>
        
    </div>
</div>

<?php include './Footer.php'; ?>