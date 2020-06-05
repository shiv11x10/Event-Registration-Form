<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "stackhack";

$error = "";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["id_card"]["name"]);

 if (array_key_exists("submit", $_POST)) {

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    if(!$_POST['name']) {
                
        $error .= "*Name<br>";

    } 
            
    if(!$_POST['email']) {
                
        $error .= "*Email<br>";
                
    } 
    
    if(!$_POST['phone']) {
                
        $error .= "*College<br>";
                
    } 
    
    if(!$_POST['registration-type']) {
                
        $error .= "*registration-type<br>";
                
    } 
    
    if(!$_POST['tickets']) {
                
        $error .= "*Tickets<br>";
                
    } 
    
    if(!$_FILES["id_card"]["name"]) {
                
        $error .= "*ID card<br>";
                
    } 
    
    
    if($error != "") {
        
        $error = "<p>Following fields are empty<p>".$error;
        echo '<script>alert("'.$error.'")</script>';
        
    } else {
        if (move_uploaded_file($_FILES["id_card"]["tmp_name"], $target_file)) {
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
        $image = basename( $_FILES["id_card"]["name"]);

        $sql = "INSERT INTO `registrations` (`Name`, `Email`, `phone`, `Registration type`, `No of tickets`, `ID Card`)
         VALUES ('".mysqli_real_escape_string($conn, $_POST['name'])."','"
        .mysqli_real_escape_string($conn, $_POST['email'])."','"
        .mysqli_real_escape_string($conn, $_POST['phone'])."','"
        .mysqli_real_escape_string($conn, $_POST['registration-type'])."','"
        .mysqli_real_escape_string($conn, $_POST['tickets'])."','"
         .mysqli_real_escape_string($conn, $image)."')";
    
        if (mysqli_query($conn, $sql)) {

            //echo "Registration successful";
          
          $last_id = 11000 + mysqli_insert_id($conn);
          
           
//            $to = $_POST['email'];
//             $subject = "Event Name";
//             $txt = "Registration successful,<br><br>
// Registration Id-  <b>EVENT".$last_id."</b><br><br>
// You have successfully registered for the Event.<br>";
//             $headers = "From: Event shivam96.sa@gmail.com" . "\r\n"."Organization: _\r\n"."Reply-To: EVENT shivam96.sa@gmail.com\r\n"."Return-Path: shivam96.sa@gmail.com\r\n"."MIME-Version: 1.0\r\n"."Content-type: text/html; charset=iso-8859-1\r\n"."X-Priority: 3\r\n";
        
//             mail($to,$subject,$txt,$headers); 
            
           echo '<script>alert("Your Registration id is: event'.$last_id.'")</script>';
       
        } else {
           printf("error: %s\n", mysqli_error($conn));
             echo "Could not register";
        }
    	
        
    }

}
mysqli_close($conn);
                    
       
?>