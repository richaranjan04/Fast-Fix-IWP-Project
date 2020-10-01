<?php
session_start();
if(empty($_SESSION['username'])){
 header('location:login.php');
}

?>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iwp";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
 
    
$id = $brand = $model = $imei = $problem = $exp = $image = $yn="";
$imeiErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["imei"])) {
    $imeiErr = "IMEI number is required";
  } else {
    $imei = test_input($_POST["imei"]);
    
    if (!preg_match(" /^[0-9]{15}$/",$imei)) {
      $imeiErr = "Invalid IMEI number"; 
    }
  }
    
    $brand=test_input($_POST["brand_name"]);
    $model=test_input($_POST["model"]);
    $problem=$_POST["problem"];
    $pr="";
    foreach($problem as $pr1)
    {
        $pr .= $pr1.",";
    }
    $exp = test_input($_POST["exp"]);   
    
    $imagetmp=addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

    
    $yn = test_input($_POST["yn"]);
    
    $sql = "INSERT INTO data (brand, model,imei,problem,exp,image,yn)
    VALUES ('$brand', '$model','$imei','$pr','$exp','$imagetmp','$yn')";
    
    if (mysqli_query($conn, $sql)) {
    header("location:personal_info.php");
    } else {
    echo "";
    }

  }
    
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
       
       
       <html>
        <head>
        <title> FastFix</title>
        <link rel="shortcut icon" href="images/title.png" type="image/png">
        <link href="phone_info.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
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
<div class="container" style="padding: 40px;">


<form name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">

<fieldset style="border: 2px solid black;padding: 30px;">
<legend style="font-family: 'Arvo', serif;"> Enter Phone Details:&nbsp; <i class="fas fa-mobile-alt"></i></legend>
<label for="phone brands"><b>Select the brand and Model of your phone:</b></label>
<br>

<div class="form-row">
<select  name="brand_name" id="ph" onchange="ChangephoneList()" class="form-control form-group col-md-4" style="margin-left: 30px;" required> 
  <option value="">--Brands--</option> 
  <option value="apple">Apple</option> 
  <option value="samsung">Samsung</option> 
  <option value="motorola">Motorola</option> 
  <option value="redmi">Redmi</option> 
  <option value="vivo">Vivo</option> 
</select> 

<select id="phonemodel" name="model" class="form-group form-control col-md-4" style="margin-left:20px;" required></select> 

<script>
var phone = {};
phone['apple']=['iphone 4','iphone 4s','iphone 5c','iphone 5s','iphone 6','iphone 6 plus','iphone 6 s','iphone 6s', 'iphone 6s plus'];
phone['samsung']=['Samsung galaxy s3','Samsung galaxy s4','Samsung galaxy s5','Samsung galaxy s6','Samsung j2','Samsung j3','Samsung j7','Samsung j7'];
phone['motorola']=['Moto E','Moto E3','Moto G4','Moto G5','Moto X'];
phone['redmi']=['Redmi 3','Redmi 3s','Redmi 3s-prime','Redmi note 3','Redmi note 4','Redmi 5'];
phone['vivo']=['Vivo v3','Vivo v1 max','Vivo Y15','Vivo Y21','Vivo Y28'];

function ChangephoneList() {
    var phoneList = document.getElementById("ph");
    var modelList = document.getElementById("phonemodel");
    var selphone = phoneList.options[phoneList.selectedIndex].value;
    while (modelList.options.length) {
        modelList.remove(0);
    }
    var phones = phone[selphone];
    //console.log(phones);
    if (phones) {
        var i;
        for (i = 0; i < phones.length; i++) {
            var a = new Option(phones[i], phones[i]);
            modelList.options.add(a);
            //console.log(phones[i]);
        }
        console.log(a);
    }
} 
</script>
</div>
<hr>
<div class="form-group col-md-6">
<label>  <b>IMEI Number</b></label>
<input type="text" class="form-control" id="imei" name="imei" placeholder="IMEI Number" value="<?php echo $imei;?>">
<div id="p">* <?php echo $imeiErr;?></div>
</div>

<hr>
<label for="phone brands"><b>Problem/Problems Faced:</b></label><br>
<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" name="problem[]" id="inlineCheckbox1" value="Charging Problem Repair">
<label class="form-check-label" for="inlineCheckbox1" >Charging Problem Repair</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox"  name="problem[]" id="inlineCheckbox2" value="Touch and LCD Repair">
<label class="form-check-label" for="inlineCheckbox2">Touch and LCD Repair</label>
</div>

<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" name="problem[]" id="inlineCheckbox1" value="Glass/ Touchscreen Repair">
<label class="form-check-label" for="inlineCheckbox1">Glass/ Touchscreen Repair</label>
</div>

<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" name="problem[]" id="inlineCheckbox1" value="Camera Repair">
<label class="form-check-label" for="inlineCheckbox1">Camera Repair</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" name="problem[]" id="inlineCheckbox2" value="Headphone Jack Repair">
<label class="form-check-label" for="inlineCheckbox2">Headphone Jack Repair</label>
</div>


&nbsp;
<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" name="problem[]" id="inlineCheckbox2" value="Volume Button Repair">
<label class="form-check-label" for="inlineCheckbox2">Volume Button Repair</label>
</div>

&nbsp;&nbsp;&nbsp;
<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox"  name="problem[]" id="inlineCheckbox1" value="Frame Replace">
<label class="form-check-label" for="inlineCheckbox1">Frame Replace</label>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" name="problem[]" id="inlineCheckbox2" value="Water Damage Repair">
<label class="form-check-label" for="inlineCheckbox2">Water Damage Repair</label>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div class="form-check form-check-inline">
<input class="form-ch&nbsp;&nbsp;&nbsp;eck-input" type="checkbox" name="problem[]"  id="inlineCheckbox2" value="Other Problem">
<label class="form-check-label" for="inlineCheckbox2">Other Problem</label>
</div>
<hr>
 <div class="form-group">
<label for="exampleFormControlTextarea1" style="overflow: scroll;"><b>Expalin your problem:</b></label>
<textarea class="form-control" name="exp" id="exampleFormControlTextarea1" rows="3" placeholder="Explain your problem..."></textarea>
<br>
<label><b>Upload a picture of your phone:</b></label>
<div class="input-group mb-3">

<br>
<div class="custom-file">
<input type="file" name="image" class="custom-file-input" id="image"/>
<label class="custom-file-label" for="inputGroupFile02">Choose file</label>
</div>
<hr>
</div>
</div>

<br>
<label for="phone brands"><b>Do you require a temporary spare phone?</b></label><br>
<div class="form-check">
<input class="form-check-input" type="radio" name="yn" id="exampleRadios1" value="yes" checked required>
<label class="form-check-label" for="exampleRadios1">Yes</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="yn" id="exampleRadios2" value="no">
<label class="form-check-label" for="exampleRadios2">No</label>
<br>
<input type="submit" name="submit" id="insert" class="btn btn-secondary active"  value="Next >>"aria-pressed="true" style="float:right;">
</div>
<script>
$(document).ready(function(){
    $('#insert').click(function(){
        var image_name = $('#image').val();
        if(image_name == '')
            {
                alert("Please upload an image");
                return false;
            }
        else{
            var extension = $('#image').val().split('.').pop().toLowerCase();
            if(jQuery.inArray(extension,['gif','png','jpg','jpeg'])== -1)
                {
                    alert("Invalid Image file");
                    $('#image').val('');
                    return false;
                }
        }
        
    });
});    
</script>

</fieldset>
</form>
</div> 
</div>   

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>  
   
</body>
</html>

