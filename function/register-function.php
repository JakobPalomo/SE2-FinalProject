<?php
session_start();
//database connection
include('../dbcon.php');


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require '../vendor/autoload.php';

function sendemail_verify($fname,$lname,$email,$verify_token)
{
    $name = $fname . " " . $lname;
    $mail = new PHPMailer(true);

    $mail->isSMTP();   
    $mail->SMTPAuth   = true;                             

    $mail->Host       = 'smtp.gmail.com';                                    
    $mail->Username   = 'cdemailverify@gmail.com';                    
    $mail->Password   = 'imse cgjh qyzq bwhg';    
    $mail->SMTPSecure ="tls";
      
    $mail->Port       = 587;           
    
    $mail->setFrom("cdemailverify@gmail.com", $name);
    $mail->addAddress($email);

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification';

    $email_template = "<h2>You have registered</h2>
 <h5>Verify your email address to login <h5>
 <br/>
 <a href ='http://localhost/SE2-FINALPROJECT/function/verify-email.php?token=$verify_token'>Click Me</a>";


    $mail->Body = $email_template;
    $mail->send();
    if(!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message has been sent";
    }
    
    
}


//gets the input from the form
if(isset($_POST['register_btn']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $verify_token= md5(rand());

 //Email exists or not
 $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
 $check_email_query_run = mysqli_query($con, $check_email_query);

 if(mysqli_num_rows($check_email_query_run) > 0)
 {
         $_SESSION['status'] = "Email  already exists";
        header("Location: ../register.php");
 }
 else
 {
     //Register user data
     $query ="INSERT INTO users (fname, lname, email, contact, address, password, verify_token) VALUES ('$fname','$lname','$email','$contact','$address','$password','$verify_token')"; 
     $query_run = mysqli_query($con, $query);

     if($query_run)
     {
        sendemail_verify("$fname","$lname","$email", "$verify_token");


         $_SESSION['status'] = "Registration Succesful! Verify your Email";
         header("Location: ../register.php");
     }
     else
     {
         $_SESSION['status'] = "Registration Failed";
         header("Location: ../register.php");
     }
 }

   
}
?>