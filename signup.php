<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iwp";


// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
   
<html>
    <head>
        <title> FastFix</title>
        <link rel="shortcut icon" href="images/title.png" type="image/png">
        <link href="signup.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style>
        #e {color: #FF0000;font-size: 11px;}
       </style>

    </head>

<body>
<?php
// define variables and set to empty values
$nameErr = $emailErr = $passErr = $cpassErr = $usernameErr = "";
$name = $email = $pass = $cpass = $username = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } 
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])) {
      $nameErr = "Only letters and white space allowed"; 
    }
    else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } 
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
    else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    
  }
    if (empty($_POST["pass"])) {
    $passErr = "Password cannot be empty !";
  } if (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/",$_POST["pass"])) {
      $passErr = "Invalid format of password"; 
    }
    else {
    $pass = test_input($_POST["pass"]);
    // check if name only contains letters and whitespace
    
  }
    
    if (empty($_POST["cpass"])) {
    $cpassErr = "Re-enter password!";
    } 
    
    $cpass=test_input($_POST["cpass"]);
        
    if ($cpass != $pass) {
    $cpassErr = "Incorrect re-entered password!"; 
    }
        
        
    // check if name only contains letters and whitespace
    
  
    if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
  } if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["username"])) {
      $usernameErr = "Only letters and numbers allowed."; 
    }
    else {
    $username = test_input($_POST["username"]);
    // check if name only contains letters and whitespace
    
  }
    
if(empty($nameErr) && empty($emailErr) && empty($passErr) && empty($cpassErr) && empty($usernameErr))
{
    
$sql = "INSERT INTO signup (name,email,password,cpass,username)
VALUES ('$name', '$email','$pass','$cpass','$username')";

if (mysqli_query($conn, $sql)) {
    header("location:login.php");
} else {
    echo "";
}
}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
    
mysqli_close($conn); 
?>
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
            <h1 class="h1-css">Sign Up</h1>
            
               <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                
                <div style="overflow: hidden">
                <p style="float: left;">Full name </p><div id="e">* <?php echo $nameErr;?></div>
                </div>
                <input type="text" id="name" placeholder="Enter Your Full Name" name="name" value="<?php echo $name;?>">
                
                <div style="overflow: hidden">
                <p style="float: left;">Email</p><div id="e">* <?php echo $emailErr;?></div>
                </div>
                <input type="text" id="email" placeholder="Enter Email Address" name="email" value="<?php echo $email;?>">
                
                <div style="overflow: hidden">
                <p style="float: left;">Password</p><div id="e">* <?php echo $passErr;?></div>
                </div>
                <input type="password" id="pass" placeholder="Enter Password" name="pass" value="<?php echo $pass;?>">
                
                <div style="overflow: hidden">
                <p style="float: left;">Confirm Password</p><div id="e">* <?php echo $cpassErr;?></div>
                </div>
                <input type="password" id="cpass" placeholder="Enter Password" name="cpass" value="<?php echo $cpass;?>">
                
                <div style="overflow: hidden;">
                <p style="float: left;">Username</p><div id="e">* <?php echo $usernameErr;?></div>
                </div>
                <input type="text" id="username" placeholder="Enter Username" maxlength="10" name="username" value="<?php echo $username;?>">

                <center> <input type="submit" value="Sign Up" name="submit" class="register"></center>
              </form>

        </div>
        </div>

    </body>
</html>
