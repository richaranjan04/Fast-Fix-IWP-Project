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
        <link href="hurray.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    </head>
    <body>
        <div class="circle">
            <img src="images/happiness.png">
            Cheers ! We have recieved your order.We will get back to you soon.
        </div>
        <form action="login.php">
           <center><input type="submit" class="btn btn-danger" value="LogOut"></center> 
        </form>
    </body>

</html>
<?php
session_destroy(); 
?>