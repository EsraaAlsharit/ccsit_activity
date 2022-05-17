<?php

$title = "Search Result";
include 'Header.php';

if(isset($_POST['serch'])){
    
    $serch = $_POST['serch'];
    $serch= preg_replace("#[^0-9a-z]#i", "", $serch);
    
    $query="SELECT * FROM poster WHERE Title LIKE '%$serch%' OR Date LIKE '%$serch%' OR Author LIKE '%$serch%' ";
    $result= mysqli_query($con, $query);
    $Sposter= array();
    
    if($result){
        while ($row= mysqli_fetch_assoc($result)){
            
            $Sposter[$row['No']] = array(
                    'no'=>$row['No'],
                    'title' => $row['Title'],
                    'img'=>$row['Img'],
                    );
  
        }
    }
   
        
    
   
    $query="SELECT * FROM news WHERE Title LIKE '%$serch%' OR Date LIKE '%$serch%' ";
    $result= mysqli_query($con, $query);
    $Snews= array();
    
    if($result){
        while ($row= mysqli_fetch_assoc($result)){
            
            $Snews[$row['No']] = array(
                    'no'=>$row['No'],
                    'title' => $row['Title'],
                    'img'=>$row['Img'],
                    );
        }
    }
    
    $query="SELECT * FROM clubs WHERE Name LIKE '%$serch%' OR Leader LIKE '%$serch%' ";
    $result= mysqli_query($con, $query);
    $Sclub= array();
    
    if($result){
        while ($row= mysqli_fetch_assoc($result)){
            
            $Sclub[$row['No']] = array(
                    'no'=>$row['No'],
                    'name' => $row['Name'],
                    'img'=>$row['Img'],
                    );

        }
    }
    
   
}

?>


<?php if(!empty($Snews) || !empty($Sposter) || !empty($Sclub)){ ?>
<h1>Search Result</h1>

    <div id="content">
        <div class="page shirts section">
            <div class="wrapper">
                <ul class="products">
                    <?php if(!empty($Sposter)){ 
                     foreach($Sposter as $i) {?>
                        <li>
                            <a href="Posters.php?No=<?php echo  $i['no']; ?>">  
                                <p><?php echo $i['title'];?></p>
                                <img width="50px" src="<?php echo $i['img']; ?>" alt="<?php echo $i['title']; ?>"/>
                                <p>View Details</p>
                            </a>
                        </li>
                    <?php } ?>

<?php } if(!empty($Snews)){ ?>

                    <?php foreach($Snews as $i) {?>
                        <li>
                            <a href="News.php?No=<?php echo  $i['no']; ?>">  
                                <p><?php echo $i['title'];?></p>
                                <img width="50px" src="<?php echo $i['img']; ?>" alt="<?php echo $i['title']; ?>"/>
                                <p>View Details</p>
                            </a>
                        </li>
                    <?php } ?>
                

<?php } if(!empty($Sclub)){ ?>
 
                    <?php foreach($Sclub as $i) {?>
                        <li>
                            <a href="Clubinfo.php?No=<?php echo  $i['no']; ?>">  
                                <p><?php echo $i['name'];?></p>
                                <img width="50px" src="<?php echo $i['img']; ?>" alt="<?php echo $i['name']; ?>"/>
                                <p>View Details</p>
                            </a>
                        </li>
<?php }} ?>
                </ul>
            </div>    
        </div>
    </div>

<?php } 
else{?>
<div id="content">
	<div class="section shirts latest">
		<div class="wrapper">
                    <h1>there is not result</h1>    	            
		</div>
	</div>
</div>
<?php } ?>

<?php include 'Footer.php'; ?> 