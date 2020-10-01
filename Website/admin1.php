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
        <link href="css/admin1.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
         <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <style>
        table {
        border-collapse: collapse;
        width:95%;
        font-family: sans-serif;
        }
        th, td { text-align: left; padding: 8px; }
        tr{background-color: #f2f2f2}
        th { background-color:#343A40; color: white;
        }
     
        </style>
        </head>
    
<body>
        <nav class="navbar navbar-dark bg-dark" style="height: 75px;">
        <a class="navbar-brand"><img src="images/mainlogo3.png" style="height: 60px; width: 130px; margin-left:20px;"></a>
        <form class="form-inline" >
        <button class="btn btn-light" style="margin-top: 15px;" type="submit" >Logout <i class="fas fa-sign-out-alt"></i></button>
        </form>
        </nav>
<br>
<br>         
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iwp";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$don="no";
$sql = "SELECT id, brand,problem,city,dat,tfrom,tto,yn FROM data WHERE done='no'";
if ($res = mysqli_query($conn, $sql))

{ 
    if (mysqli_num_rows($res) > 0) { 
        echo "<table border=\"1\" align=\"center\">"; 
        echo "<tr>"; 
        echo "<th>Id</th>"; 
        echo "<th>Brand</th>"; 
        echo "<th style=\"padding-left:120px;\">Issue</th>"; 
        echo "<th>Location</th>"; 
        echo "<th style=\"padding-left:30px;\"> Date</th>"; 
        echo "<th colspan=\"2\" style=\"padding-left:50px;\">Time</th>";
        echo "<th style=\"padding-left: 30px;\">Spare Phone Required</th>";
        echo "<th>View</th>";
        echo "</tr>"; 
        while ($row = mysqli_fetch_array($res)) { 
            echo "<tr>"; 
            echo "<td>".$row['id']."</td>"; 
            echo "<td>".$row['brand']."</td>"; 
            echo "<td>".$row['problem']."</td>";
            echo "<td>".$row['city']."</td>"; 
            echo "<td>".$row['dat']."</td>";
            echo"<td>".$row['tfrom']."</td>";
            echo"<td>".$row['tto']."</td>";
            echo"<td style=\"padding-left: 80px;\">".$row['yn']."</td>";
            echo "<td><a href='admin_display.php?id=".$row['id']."'>View</a></td>";       
            echo "</tr>"; 
        } 
        echo "</table>"; 
        
        
    } 
    else { 
        echo "No matching records are found."; 
    } 
} 
 
mysqli_close($conn); 
?> 
   
</body>
</html>


<!--<input class='btn btn-outline-dark'  type='submit' formaction='ses.php' formmethod='post' value='View'/>-->