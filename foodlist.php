<?php
session_start();

if(!isset($_SESSION['login_user2'])){
header("location: customerlogin.php"); 
}

?>


<html>

  <head>
    <title> Explore |  Quick Bites</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  
<link rel="stylesheet" type = "text/css" href ="css/managerlogin.css">  

  </head>

  <!--<link rel="stylesheet" type = "text/css" href ="css/foodlist.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>-->

  <body style = "background:url( images/m2.jpg")>

  
    
  <nav style="padding:20px;background-color:rgb(100, 13, 13);"  class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        

<?php

 if (isset($_SESSION['login_user2'])) {
  ?>
           <ul class="nav navbar-nav navbar-right" >
            <li><a style="color:white;font-size:25px;" href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li class="active" ><a style="color:white;font-size:25px;"href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span> Food Zone </a></li>
            <li><a style="color:white;font-size:25px;" href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart  (<?php
              if(isset($_SESSION["Cart"])){
              $count = count($_SESSION["Cart"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>) </a></li>
            <li><a style="color:white;font-size:25px;" href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
  <?php        
}
else {

  ?>



<?php
}
?>


        </div>

      </div>
    </nav>

  <!--  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" >

      <div class="item active" style="display:flex;justify-content:center;">
      <img src="image1.jpg" style="width:70%;height:70%;position:center;">
      <div class="carousel-caption">
      </div>
      </div>
       
       <div class="item">
      <img src="images/home.jpg" style="width:100%;">
      <div class="carousel-caption">

      </div>
      </div-->

     <!-- <div class="item">
      <img src="image2.jpg" style=style="width:70%;height:70%;">
      <div class="carousel-caption">

      </div>
      </div>
      <div class="item">
      <img src="image3.jpg" style="style="width:70%;height:70%;"">
      <div class="carousel-caption">
      </div>
      </div>
    
    </div>
   <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
    </div>-->

<div style="padding:130px 30px 10px 30px;" class="jumbotron">
  <div class="container text-center">
    <h1>Welcome To Quick Bites</h1>      
    <!--p>Let food be thy medicine and medicine be the food</p-->
  </div>
</div>




<div class="container" style="width:95%;">

<!-- Display all Food from food table -->
<?php

require 'connection.php';
$conn = Connect();

$sql = "SELECT * FROM FOOD WHERE options = 'ENABLE' ORDER BY F_ID";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
  $count=0;

  while($row = mysqli_fetch_assoc($result)){
    if ($count == 0)
      echo "<div class='row'>";

?>
<div class="col-md-3">

<form style="border:2px solid rgb(100,13,13);padding:20px;border-radius:20px;" method="post" action="cart.php?action=add&id=<?php echo $row["F_ID"]; ?>">
<div class="mypanel" align="center";>
<img src="<?php echo $row["images_path"]; ?>" class="img-responsive">
<h4 class="text-dark"><?php echo $row["name"]; ?></h4>
<h5 class="text-info"><?php echo $row["description"]; ?></h5>
<h5 class="text-danger">&#8377; <?php echo $row["price"]; ?>/-</h5>
<h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> </h5>
<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
<input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">
<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
</div>
</form>
      
     
</div>

<?php
$count++;
if($count==4)
{
  echo "</div>";
  $count=0;
}
}
?>

</div>
</div>
<?php
}
else
{
  ?>

  <div class="container">
    <div class="jumbotron">
      <center>
         <label style="margin-left: 5px;color: red;"> <h1>Oops! No food is available.</h1> </label>
        <p>Stay Hungry...! :P</p>
      </center>
       
    </div>
  </div>

  <?php

}

?>

   
</body>
</html>