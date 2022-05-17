<!DOCTYPE html>
<html>
<head>
    <?php 
    
            include 'DB.php';
            
            

            ?>
    
    <link rel="stylesheet" href="css/Style.css">
    <script type="text/javascript" src="js/validation.js"></script>
    <link rel="shortcut icon" href="favicon.ico">
    <title> CCSIT ACTIVITY -<?php echo $title; ?> </title>
</head>

<body>
    
    <div class="top">
        
        <div class="account">    
            <?php 
            session_start();
     
                      
            if(isset($_SESSION['user'])){ ?>
            <button  name="logout"  id="logout" onclick="window.location.href='logout.php'" >logout</button>
            
            <?php if(isset($_SESSION['user']) && $_SESSION['user']==="admin"){ ?>
                <button  name="adminPro"  onclick="window.location.href='adminPro.php'" ><?php echo $_SESSION['user']?></button>
                <?php } elseif(isset($_SESSION['user'])){ ?>
                <button  name="userPro"  onclick="window.location.href='userPro.php'" ><?php echo $_SESSION['user']?></button>    
               <?php }
            }
            else {?>
            
                    <button  name="login" id="login" onclick="window.location.href='LogIn.php'">Login</button>
                    <button  name="SingUp" id="SingUp" onclick="window.location.href='SignUp.php'" >Sing up</button>   
            <?php } ?>  
        </div>
        
        <div class="activAccount">
            <menu></menu>
            <a href="Calendar.php"><img src="img/calendar.png" alt="Calendar" width="20px;"></a>
            
        </div>
        
    </div>       
        
    <div class="header">

        <a href="index.php"><img src="img/ccsit.png" width="120px" class="logo"/></a>

        <div class="nav">

                <button class="tablink" onclick="window.location.href='index.php'" >Home</button>
               <button class="tablink" onclick="window.location.href='clubs.php'">Clubs</button>
                <button class="tablink" onclick="window.location.href='News&Posters.php'" >News</button>
                <button class="tablink" onclick="window.location.href='Support.php'" >Support</button>


        </div>

        <div class="server">

            <form method="POST" action="Search.php" >
                <input name="serch" id="serch" type="search" placeholder="serch" >
                <input type="submit">
                </form>
        </div>
    </div>
        
  </body>  
</html>

	


