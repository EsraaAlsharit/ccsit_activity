
<?php

$title = "Update news";
include 'Header.php'; 


if(!isset($_SESSION['user']))
{
    header('Location: error.php');
}
$U=$_SESSION['user'];
    if(!$U=='admin'){
        header("Location: error.php");
    }
    

if(isset($_GET['No'])) //107
{

    $id = $_GET['No'];
    $query = "SELECT * FROM news WHERE No='$id'";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result))
{

$news = array(
                    'no'=>$row['No'],
                    'title' => $row['Title'],
                    'details'=>$row['Details'],
                    'img'=>$row['Img'],
                    'date'=>$row['Date']
                    );

}

}

if(isset($_POST['update']))
{
        $id = $_POST['no'];
        $title = $_POST['title'];
        $des = $_POST['des'];
        $date = $_POST['date'];
        

        //IF the user uploaded a new image
        if(!empty($_FILES['image']['name']))
        {
             
            $filename = $_FILES['image']['name'];
            $tmp  = $_FILES['image']['tmp_name'];
            $size = $_FILES['image']['size'];
            $error = $_FILES['image']['error'];
            $type = $_FILES['image']['type'];

            

            //STEP 1: Construct the Destination Path
            $path = "img/news/";
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
                    $query = "UPDATE news SET Title='$title', Details='$des' Date='$date' ,  img = '$path' WHERE No=$id";                  
                }
            }
            else
            {
                header("Location: adminPro.php?status=notdone");
            }
        }
        else   //IF no new image is uploaded from the update form
        {
           
            $out = 1;
            $query = "UPDATE news SET Title='$title', Details='$des' , Date='$date' WHERE No=$id";  
        }

        if($out==1)
        {
            //STEP 5: Run the Query
            $res = mysqli_query($con, $query);        

            //STEP 6: Check the result
            if($res==1)
            {
                
                header("Location: adminPro.php?status=done");
            }
            else
            {
                header("Location: adminPro.php?status=notdone");
                
            }
        }
        else
        {
            header("Location: adminPro.php?status=notdone");
        }                

        
}
?>

<div id="content">
   
   <div class="page section">
    <h1>Update Poster</h1>
    
 
    
    <form id="update" name="update" method="POST" action="ModifyNews.php" enctype="multipart/form-data">

                    <table>
                        <tr>
                            <th>
                                <label for="pid">Title</label>
                            </th>
                            <td>
                                <input type="hidden" name="no" value="<?php echo $news['no']; ?>">
                                <input type="text" name="title"  value="<?php echo $news['title']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="name">Details</label>
                            </th>
                            <td>
                                <textarea name="des" rows="15" cols="10" ><?php echo $news['details']; ?></textarea>
                            </td>
                        </tr>
                      
                        
                                                
                         
                        
                        <tr>
                            <th>
                                <label for="image">Upload Image</label>
                            </th>
                            <td>
                                <img width="100" height="100" src="<?php echo $news['img']; ?>"/>
                                <input type="file" name="image" >
                                <input type="hidden" name="imageret" value="<?php echo $news['img'] ?>" > 
                                <span style="font-size: 0.6em; font-style: italic;">(Maximum 500 KB)</span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="price">Date</label>
                            </th>
                            <td>
                                <input type="date" name="date" value="<?php echo $news['date']; ?>">
                                
                            </td>
                        </tr> 
                                            
                    </table>
                    <input type="submit" value="Update" name="update">

                </form>
        
    </div>
</div>

<?php include './Footer.php'; ?>