<html>

    <head>
     
     
        <?php $title="News" ;
        include './Header.php'; 
        
        $query = "SELECT * FROM news";


$result = mysqli_query($con,$query);
$News = array();

//STEP 6: RETRIEVE VALUES FROM RESULT
while($row = mysqli_fetch_assoc($result))
{

$News[$row['No']] = array(
                    'no'=>$row['No'],
                    'title' => $row['Title'],
                    'details'=>$row['Details'],
                    'img'=>$row['Img'],
                    'date'=>$row['Date']
                    );

}


$Query = "SELECT * FROM poster";


$result = mysqli_query($con,$Query);
$Post = array();

//STEP 6: RETRIEVE VALUES FROM RESULT
while($row = mysqli_fetch_assoc($result))
{

$Post[$row['No']] = array(
                    'no'=>$row['No'],
                    'title' => $row['Title'],
                    'des'=>$row['Description'],
                    'place'=>$row['Place'],
                    'img'=>$row['Img'],
                    'time'=>$row['Time'],
                    'aother'=>$row['Author'],
                    'date'=>$row['Date']
                    );

}

        ?>
    </head>
    
    <body>
       
            
    <div id="content">

        <div class="page shirts section">
            <div class="wrapper">

            <h1>News</h1>

                <ul class="products">
                    <?php foreach($News as $i) {?>
                        <li>
                            <a href="News.php?No=<?php echo  $i['no']; ?>">  
                                <p><?php echo $i['title'];?></p>
                                <img width="50px" src="<?php echo $i['img']; ?>" alt="<?php echo $i['title']; ?>"/>
                                <p>View Details</p>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>    
        </div>
    </div>
        
        <hr>
        
         <div class="content">
            
<div class="page shirts section">
    <div class="wrapper">
            <h1>Poster</h1>
            <ul class="products">
           
                <?php foreach($Post as $i) {?>
            <li>
                <a href="Posters.php?No=<?php echo  $i['no']; ?>">  
                <p><?php echo $i['title'];?></p>
                <img src="<?php echo $i['img']; ?>" alt="<?php echo $i['title']; ?>"/>
                <p>View Details</p>
                </a>
            </li>
            <?php } ?>
            </ul>
            
              </div>
    </div>
         </div>
            
      
        
        
         <?php include 'Footer.php'; ?>
        
    </body>
</html>