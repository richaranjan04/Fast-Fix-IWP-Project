<?php
    
session_start();

?>
<?php

$txt=$_SESSION['id'];
$e= $_SESSION['email'];
//echo $txt;
//echo $e;
//print_r($_SESSION);

$meg="";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/Applications/XAMPP/xamppfiles/htdocs/vendor/autoload.php';       
$errors="";
$con=mysqli_connect("localhost","root","","iwp"); 
if (mysqli_connect_errno()) 
{ 
echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$meg=$_POST["meg"];

$sql = ("UPDATE data SET done='yes' WHERE id=". $txt);
if (mysqli_query($con, $sql)) 
{
      
    //Get the uploaded file information
    $upload_folder="upload_folder/";
    $name_of_uploaded_file =basename($_FILES['uploaded_file']['name']);
    //echo  $name_of_uploaded_file;

   //get the file extension of the file
    $type_of_uploaded_file =substr($name_of_uploaded_file,strrpos($name_of_uploaded_file, '.') + 1);

    $size_of_uploaded_file =$_FILES["uploaded_file"]["size"]/1024;//size in KBs
    
    //Settings
   $max_allowed_file_size = 2000; // size in KB
   $allowed_extensions = array("jpg", "jpeg", "gif", "bmp");

   //Validations
   if($size_of_uploaded_file > $max_allowed_file_size )
   {
     $errors .= "\n Size of file should be less than $max_allowed_file_size";
   }

    //------ Validate the file extension -----
    $allowed_ext = false;
    for($i=0; $i<sizeof($allowed_extensions); $i++)
    {
     if(strcasecmp($allowed_extensions[$i],$type_of_uploaded_file) == 0)
    {
      $allowed_ext = true;
    }
    }

    if(!$allowed_ext)
    {
    $errors .= "\n Unsupported type. "." Only the following file types are supported:".implode(',',$allowed_extensions);
    }
    //copy the temp. uploaded file to uploads folder
    $path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;
    $tmp_path = $_FILES["uploaded_file"]["tmp_name"];

    if(is_uploaded_file($tmp_path))
    {
    if(!copy($tmp_path,$path_of_uploaded_file))
    {
    $errors .= '\n error while copying the uploaded file';
    }
    }
    //echo $path_of_uploaded_file;  
           
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
    $mail->addAddress($e, 'Customer');     
    
    $mail->isHTML(true);                               
    $mail->Subject = 'Cell Phone Repaired!';
    $mail->Body    = $meg;
    $mail->addAttachment("upload_folder/".$name_of_uploaded_file);

        
    if($mail->send()){
    
    echo'<script>window.location.href="hurray1.php"; </script>';
    }
    
} 
    catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
}
} 
mysqli_close($con); 
?>