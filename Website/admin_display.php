<?php
session_start();
if(empty($_SESSION['username'])){
 header('location:login.php');
}

?>
<html>
<head>
        <title>FastFix</title>
        <link rel="shortcut icon" href="images/title.png" type="image/png">
        <link href="admin_display.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <style>
        table {
        border-collapse: collapse;
        width:80%;
        font-family:serif;
        margin-right: 60px;
        margin-top: 20px;
        }
        th, td { text-align: left; padding: 8px; }
        tr{background-color: #f2f2f2}
        th { background-color:#343A40; color: white;
        }
        .column {
         float: left;
         width: 50%;
         
         padding-left: 
         }
        .row::after {
         content: "";
         clear: both;
         display: table;
         }
            .x
            {
                margin-left: 60px;
            }
            
            .btn-danger
            {
                width:150px;
            }
            .btn-success
            {
                width:300px;
            }
            
        </style>
</head>
<body>
        
<nav class="navbar navbar-dark bg-dark"  style="height: 75px;">
<a class="navbar-brand"><img src="images/mainlogo3.png" style="height: 60px; width: 130px; margin-left:20px;"></a>
</nav>


<?php
    
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/Applications/XAMPP/xamppfiles/htdocs/vendor/autoload.php';           
    
$con=mysqli_connect("localhost","root","","iwp"); 
if (mysqli_connect_errno()) 
{ 
echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
}

if(isset($_GET['id'])) {
$txt= $_GET['id'];


$result = mysqli_query($con,"SELECT * FROM data where id=" . $txt);

while($row = mysqli_fetch_array($result)) 
{
$e=$row['email'];
//echo $e;
$_SESSION['id'] = $txt;
$_SESSION['email'] = $e;
//echo "Session variables are set.";
//print_r($_SESSION);
echo "<div class=\"row\">";
echo "<div class=\"column\">";
echo "<table border=\"1\" align=\"center\">";
echo "<th colspan=\"2\">Mobile Phone Details</th>";
echo"<br>";
echo '<tr>
        <td>
            <img width="400px" height="410px" class="x" src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>
        </td>
    </tr>';
echo"</table>";

echo"</div>";
echo "<div class=\"column\">";
echo "<table border=\"1\" style=\"margin-top:44px;height:462px;\">";
echo "<tr>";  
echo "<th colspan=\"2\">Mobile Phone Details</th>";
echo "</tr>";
echo"<tr>";

echo "<td>Brand : </td>";
echo "<td>" . $row['brand'] . "</td>";
echo "</tr>"; 
echo"<tr>";
echo "<td>Model : </td>";
echo "<td>" . $row['model'] . "</td>";
echo "</tr>"; 
echo"<tr>";
echo "<td>IMEI Number: </td>";
echo "<td>" . $row['imei'] . "</td>";
echo "</tr>"; 
echo"<tr>";
echo "<td>Problem Faced: </td>";
echo "<td>" . $row['problem'] . "</td>";
echo "</tr>"; 
echo"<tr>";
echo "<td>Explanation : </td>";
echo "<td>" . $row['exp'] . "</td>";
echo "</tr>"; 
echo"<tr>";
echo "<th colspan=\"2\">Personal Details</th>";
echo"</tr>";
echo"<tr>";
echo "<td>First Name : </td>";
echo "<td>" . $row['fname'] . "</td>";
echo"</tr>";
echo"<tr>";
echo "<td>Last Name : </td>";
echo "<td>" . $row['lname'] . "</td>";
echo"</tr>";
echo"<tr>";
echo "<td>E-mail ID : </td>";
echo "<td>" . $row['email'] . "</td>";
echo"</tr>";
echo"<tr>";
echo "<td>Contact Number : </td>";
echo "<td>" . $row['contact'] . "</td>";
echo"</tr>";
echo"<tr>";
echo "<td>Address : </td>";
echo "<td>" . $row['address'] .",".$row['city'].",".$row['state'].",".$row['pin']."</td>";
echo"</tr>";
} 
echo "</table>"; 
}
echo"</div>"; 
echo"</div>";
 
mysqli_close($con); 
?>

<div class="container" style="margin-top: 20px">
<form action="mail.php" method="post" enctype="multipart/form-data">
<label for='message'><b>Send Mail to the client: </b></label>
<br>
<textarea name="meg" class="border border-dark rounded" cols="130" rows="2" style="overflow: scroll;"></textarea>
<br>

<label><b>Upload Snapshort of Bill:</b></label>
<div class="input-group mb-3">
<br>
<div class="custom-file">
<input type="file" name="uploaded_file" class="custom-file-input" id="image"/>
<label class="custom-file-label" for="inputGroupFile02">Choose File</label>
</div>

<center>
<input type="submit" name="submit" class="btn btn-success" value="Send Mail and Delete Order from List"></center>
</div>
</form>
</div> 
</body>
</html>

