<html>
    <head>
        
        
     <?php 
     include_once 'DB.php';
     if(isset($_GET['No']))
    {

    $id = $_GET['No'];
    $query = "SELECT * FROM clubs WHERE No=$id";
    $result = mysqli_query($con, $query);

        while($row = mysqli_fetch_assoc($result))
        {
            $club = array(
                'no'=>$row['No'],
                'name' => $row['Name'],
                'about' => $row['About'],
                'vis'=>$row['Vision'],
                'mis'=>$row['Mission'],
                'obj'=>$row['Objectives'],
                'prog'=>$row['Programs'],
                'req'=>$row['Requirements'],
                'adv'=>$row['Advantages'],
                'img'=>$row['Img'],
                'leader'=>$row['Leader']
                );
        }
    }

     $title= $club['name'];
     include 'Header.php';

     ?>
     
    </head>
    
    <body>
        <div class="content">
            
            <?php if(!empty($club['img'])){ ?>
            <img src="<?php echo $club['img'] ?>" style="margin:0 auto; width: 100%; " ><br><br>
            <?php  } ?>
            <?php if(!empty($club['about'])){ ?>
            <P style="color: skyblue"><strong>About the Club:</strong></P><br>
            <?php echo nl2br($club['about']);  } ?>
            <br><br>
            <?php if(!empty($club['vis'])){ ?>
             <P style="color: skyblue"><strong>The Vision:</strong></P><br>
            <?php echo nl2br($club['vis']); } ?>
             <br><br>
             <?php if(!empty($club['mis'])){ ?>
            <P style="color: skyblue"><strong>The Mission:</strong></P><br>
             <?php  echo nl2br($club['mis']); }?>
            <br><br>
            <?php if(!empty($club['obj'])){ ?>
            <P style="color: skyblue"><strong>The Objectives:</strong></P><br>
            <?php echo nl2br($club['obj']); } ?>
            <br><br>
            <?php if(!empty($club['prog'])){ ?>
            <P style="color: skyblue"><strong>Club Programs:</strong></P><br>
            <?php echo nl2br($club['prog']); }?>
            <br><br>
            <?php if(!empty($club['req'])){ ?>
            <P style="color: skyblue"><strong>Membership Requirements:</strong></P><br>
            <?php echo nl2br($club['req']); }?>
            <br><br>
            <?php if(!empty($club['adv'])){ ?>
            <P style="color: skyblue"><strong>Membership Advantages:</strong></P><br>
            <?php echo nl2br($club['adv']) ; }?>
            
             <br>
             <br>
             <!--button  onclick="window.location.href='Clubinfo.php?No='+<?php echo $club['no']?>"> join</button-->
             <a href="join.php?request=<?php echo $club['name']?>"><button >join</button></a>
            </div>
      
            
    </body>
    <?php include 'Footer.php'; ?> 
</html>