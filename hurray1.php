<?php
session_start();
if(empty($_SESSION['username'])){
 header('location:login.php');
}
?>
<html>
   <head>
        <title> FastFix</title>
        <link rel="shortcut icon" href="images/title.png" type="image/png">
        <link href="hurray1.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    </head>
    <body>
        <div class="circle">
           <center><h2> One more phone repaired !</h2></center>
            <img src="images/rating.png">
           <br>
        </div>
      
        <form action="h.php" method="post">
           <center><input type="submit" class="btn btn-danger" class="btn" value="LogOut"><br></center> 
    
        </form>
        <center>
        <a class="btn btn-success" href="admin1.php" role="button">View More phones to repair.</a>
        </center>
    </body>

</html>



