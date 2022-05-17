
<html>
    
    <head>
        
        <?php $title="clubers";
        include './Header.php';
        
           $query = "SELECT * FROM clubs";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result))
    {

        $club[$row['No']] = array(
                    'no'=>$row['No'],
                    'name' => $row['Name'],
                    'about' => $row['About'],
                    'vis'=>$row['Vision'],
                    'mis'=>$row['Mission'],
                    'obj'=>$row['Objectives'],
                    'prog'=>$row['Programs'],
                    'req'=>$row['Requirements'],
                    'leader'=>$row['Leader']
                    );

    }
    
     if(isset($_GET['state']) && $_GET['state']==="notdone"){
    ?>
    <script> alert('your request is not send' )</script>
      <?php } 
      if(isset($_GET['state']) && $_GET['state']==="done"){?>
    <script> alert('your request is send successfully' )</script>
    <?php } ?>
        
    </head>
    <body>
        <div class="content">
            <h1>available clubs</h1>
        
           
        <div class="buttons">
               <?php foreach ($club as $i) { ?>
            <button  onclick="window.location.href='Clubinfo.php?No='+<?php echo $i['no']?>"> <?php echo $i['name']; ?></button>

            <?php }?>
            
        </div>
        
        </div>
         
        
    </body>
    <?php include 'Footer.php'; ?>
</html>