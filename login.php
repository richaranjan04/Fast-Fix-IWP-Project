<?php
session_start();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iwp";


$conn = mysqli_connect($servername, $username, $password,$dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$un = $pass ="";
$nameErr = $passErr ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
           $un=$_POST["username"];
           $pass=$_POST["password"];
           $_SESSION["username"] = $un;
           print_r($_SESSION);
               
            if($un=="admin" && $pass=="admin")
            {
            header('location:admin1.php');
            }
    
           if(empty($un)||empty($pass))
           {
                $nameErr = "Name is required";
                $passErr = "Password is required";
            }
            
            else
            {
    
            $sql="SELECT password FROM signup where username='$un'";
               
               $res=mysqli_query($conn,$sql);
               
               if(!$res)
               {
                   die("Querry failed" . mysqli_error($conn));
               }
               
               
               $row=mysqli_fetch_assoc($res);
                
               if($pass!=$row['password'])
               {
                  $passErr = " Wrong password entered !";
               }
               
                
               else
               {
                   header('location:phone_info.php');
               }         
    }
    
    }

?>
   <html>
    <head>
        <title> FastFix</title><link rel="shortcut icon" href="images/title.png" type="image/png">
        <link href="login.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style>
            #p{color: #FF0000;font-size: 13px;}
        </style>
    </head>
    
    <body>
 <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img id="size"src="images/mainlogo3.png"></a>
  
  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    
    
     <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="landing.html">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="landing.html">How it Works</a>
      </li><li class="nav-item active">
        <a class="nav-link" href="landing.html">Select your Mobile</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="landing.html">Why Us</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="landing.html">Contact Us</a>
      </li>
    </ul> 
      
   
  </div>
</nav>
        
        <div class="content">
        <div class="loginbox">
            <img src="images/user.png" class="avatar">
            <h1 class="h1-css">Login</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
               <div style="overflow: hidden">
                <p style="float: left;">Username</p><div id="p">* <?php echo $nameErr;?></div>
                </div>
                <input type="text"  placeholder="Enter Username" maxlength="10" name="username" value="<?php echo $username;?>">
                
                <div style="overflow: hidden;">
                <p style="float: left;">Password</p><div id="p">* <?php echo $passErr;?></div>
                </div>
                <input type="password" placeholder="Enter Password" id="pass" name="password" value="<?php echo $password;?>">
                <input type="submit" value="Login" name="submit" class="register">
                
                <a href="#"> Forgot Password?</a>
                <br>
                <a href="signup.html"> Signup</a>

            </form>

        </div>
        </div>

    </body>
</html>

   