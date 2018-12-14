<?php
session_start();
if(empty($_SESSION['username'])){
 header('location:login.php');
}

?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/Applications/XAMPP/xamppfiles/htdocs/vendor/autoload.php';


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iwp";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$fname = $lname = $email = $number = $address = $state = $city =$pin = $dat = $tfrom = $tto ="";
$fnameErr = $lnameErr = $emailErr = $numberErr = $cityErr = $pinErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  if (empty($_POST["fname"])) {
    $fnameErr = "First Name is required";
  } 
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["fname"])) {
      $fnameErr = "Only letters and white space allowed"; 
    }
    else {
    $fname = test_input($_POST["fname"]);
   
  }
    
    if (empty($_POST["lname"])) {
    $lnameErr = "Last Name is required";
  } 
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["lname"])) {
      $lnameErr = "Only letters and white space allowed"; 
    }
    else {
    $lname = test_input($_POST["lname"]);
    
  }
    
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } 
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
    else {
    $email = test_input($_POST["email"]);
   
    
  }
    
    if (empty($_POST["number"])) {
    $numberErr = "Mobile number id required";
  } 
    if (!preg_match("/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im",$_POST["number"])) {
      $numberErr = "Invalid Number"; 
    }
    else {
    $number = test_input($_POST["number"]);
   
  }
    
    $address=test_input($_POST["address"]);
    $state=$_POST["state"];
    
    if (empty($_POST["city"])) {
    $cityErr = "Enter your city";
  } 
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["city"])) {
      $cityErr = "Only letters and white space allowed"; 
    }
    else {
    $city = test_input($_POST["city"]);
   
  }
    
    if (empty($_POST["pin"])) {
    $pinErr = "Pincode is required";
  } 
    if (!preg_match("/^[1-9][0-9]{5}$/",$_POST["pin"])) {
      $pinErr = "Invalid Pin"; 
    }
    else {
    $pin = test_input($_POST["pin"]);
   
  }
    
    $dat=$_POST["dat"];
    $tfrom=$_POST["tfrom"];
    $tto=$_POST["tto"];
    
  
if(empty($fnameErr) && empty($lnameErr) && empty($emailErr) && empty($numberErr) &&empty($cityErr) && empty($pinErr))
{
    
    
    $last_id = "SELECT id FROM data ORDER BY id DESC LIMIT 1";
   
//    if(mysqli_query($conn, $last_id))
//    {
//         echo $last_id;
//    }
    
    $result=$conn->query($last_id);
    $row = $result->fetch_assoc();
    $iss=$row['id'];
    //echo $iss;
    $no="no";
    
    $sql= "UPDATE data SET fname='$fname',lname='$lname',email='$email',contact='$number',address='$address',state='$state', city='$city',pin='$pin',dat='$dat',tfrom='$tfrom',tto='$tto',done='$no' WHERE id=$iss";

    if (mysqli_query($conn, $sql))
    {
       
    
    $mail = new PHPMailer(true);                              
    try {
    
    $mail->SMTPDebug = 2;                                
    $mail->isSMTP();             
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;         
    $mail->Username = 'richabelair04@gmail.com';         
    $mail->Password = 'richa0404';                       
    $mail->SMTPSecure = 'tls';                           
    $mail->Port = 587;                                   
    
    $mail->setFrom('richabelair04@gmail.com', 'FastFix');
    $mail->addAddress($email, 'Customer');     
    
    $mail->isHTML(true);                               
    $mail->Subject = 'Recieved your order';
    $mail->Body    = 'We have recieved your order. We will ckeck the phone and keep you updated about the progress of repair work.';
    

    $mail->send();
    header("location:hurray.php");    
    
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
    
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
   
   <html>
    <head>
        <title> FastFix</title>
        <link rel="shortcut icon" href="images/title.png" type="image/png">
        <link href="personal_info.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <style>
        #p {color: #FF0000;font-size: 11px;}
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
         
<fieldset class="container">
<legend style="font-family: 'Arvo', serif;padding-top: 30px;"> &nbsp;Enter Your Personal Details: <i class="fas fa-edit"></i></legend>
<form name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <div class="row">
    <div class="col">
     <label >First Name </label>
      <input id="customControlValidation1" name="fname" type="text" class="form-control" placeholder="First name" required value="<?php echo $fname;?>">
      <div id="p">* <?php echo $fnameErr;?></div>
    </div>
    
    <div class="col">
     <label for="inputEmail4">Last Name</label>
      <input type="text" id="customControlValidation2" name="lname" class="form-control" placeholder="Last name" required value="<?php echo $lname;?>">
      <div id="p">* <?php echo $lnameErr;?></div>
    </div>
  </div>
  <br>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="text" class="form-control" name="email" id="inputEmail4"name="email" placeholder="Email" value="<?php echo $email;?>"required>
      <div id="p">* <?php echo $emailErr;?></div>
    </div>
    <div class="form-group col-md-6">
      <label>Contact Number</label>
      <input type="text" class="form-control" id="contactnumber" name="number" placeholder="Phone Number"value="<?php echo $number;?>" maxlength="10" required>
      <div id="p">* <?php echo $numberErr;?></div>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text"  name="address" class="form-control" id="inputAddress" value="<?php echo $address;?>"placeholder="Address" required>
  </div>
  
<div class="form-row">
<div class="form-group col-md-4">
      <label for="inputState">State</label>
      <input list="states" id="inputState" class="form-control" name="state" placeholder="State" required>
       <datalist id="states">
            <option value="Andhra Pradesh"></option>
            <option value="Arunachal Pradesh"></option>
            <option value="Assam"></option>
            <option value="Bihar"></option>
            <option value="Chhattisgarh"></option>
            <option value="Goa"></option>
            <option value="Gujarat"></option>
            <option value="Haryana"></option>
            <option value="Himachal Pradesh"></option>
            <option value="Jammu and Kashmir"></option>
            <option value="Jharkhand"></option>
            <option value="Karnataka"></option>
            <option value="Kerala"></option>
            <option value="Madhya Pradesh"></option>
            <option value="Maharashtra"></option>
            <option value="Manipur"></option>
            <option value="Meghalaya"></option>
            <option value="Mizoram"></option>
            <option value="Nagaland"></option>
            <option value="Odisha"></option>
            <option value="Punjab"></option>
            <option value="Rajasthan"></option>
            <option value="Sikkim"></option>
            <option value="Tamil Nadu"></option>
            <option value="Telangana"></option>
            <option value="Tripura"></option>
            <option value="Uttar Pradesh"></option>
            <option value="Uttarakhand"></option>
            <option value="West Bengal"></option>
   
</datalist>
</div>
<div class="form-group col-md-4">
      <label for="inputCity">City</label>
      <input type="text" name="city" class="form-control" id="inputCity" value="<?php echo $city;?>" placeholder="City" required>
      <div id="p">* <?php echo $cityErr;?></div>
    </div>
<div class="form-group col-md-2">
<label for="inputZip">Pincode</label>
<input type="text" class="form-control" name="pin" id="inputZip" value="<?php echo $pin;?>" placeholder="Pincode" required>
<div id="p">* <?php echo $pinErr;?></div>
</div>
</div>
<br>

<label>Enter the date and time for pickup according to your convenience !</label>
<hr style="color: 5px solid black">

<div class="form-row">
<div class="form-group col-md-3">
<label for="inputZip">Date</label>
<input type="date" value="<?php echo $date;?>" name="dat"class="form-control" id="inputZip" required>
</div> 
<div class="form-group col-md-3">
<label for="inputZip">From </label>
<input type="time" class="form-control" name="tfrom" value="<?php echo $tfrom;?>" id="inputZip" required>
</div> 

<div class="form-group col-md-3">
<label for="inputZip">To </label>
<input type="time" class="form-control" name="tto" value="<?php echo $tto;?>" id="inputZip" required>
</div>  
</div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck" required>
      <label class="form-check-label" for="gridCheck">
        I agree all the terms and conditions.
      </label>
    </div>
  </div><center><input type="submit" class="btn btn-dark" value="Repair"></center>
  
</form>
             
</fieldset>
</div>

</body>
</html>


