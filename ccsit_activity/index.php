<!DOCTYPE html>
<html>
<head>


<?php $title="Home";

include 'Header.php';

if (isset($_GET['status'])&& $_GET['status']==='done'){?>
  <script> alert('process done successfully' )</script><?php }
  if (isset($_GET['status'])&& $_GET['status']==='notdone'){?>
    <script> alert('process not done' )</script><?php }
    
  $today = date("Y-m-d");
    $Query = "SELECT * FROM poster WHERE Date > '$today' ";


$result = mysqli_query($con,$Query);
$Post = array();


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
   <!-- sliders-->
   
   <div class="slideshow-container">

<div class="mySlides fade">
    <a href="SignUp.php">
  <img src="img/jionthesite.jpg" alt="join" >
  </a>
</div>


<div class="mySlides fade">
    <a href="CreateClub.php">
  <img src="img/createclube.png" alt="createclub" >
  </a>
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  
</div>
   
   
    <div class="content">
        <div class="page shirts section">
            <div class="wrapper">
                <h1>Events</h1>
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
    <script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>

</body>
<?php include 'Footer.php';?>
</html>

