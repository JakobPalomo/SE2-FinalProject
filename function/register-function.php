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
    $mail->Subject = 'HACKATTACK';

    $email_template = "<h1>OOGABOOGA</h1>
    <h2>You have been abdul jamal abdulamed</h2>
 <h5>This link will give you virus real<h5>
 <br/>
 <a href ='http://localhost/SE2-FINALPROJECT/function/verify-email.php?token=$verify_token'>CLICK ME PLEASE DO IT</a>";


    $mail->Body = $email_template;
    $mail->send();
    if(!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message has been sent";
    }
    
    
}


//gets the input from the form
if(isset($_POST['register_btn'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password= $_POST['password'];
    $building_number = $_POST['building_number'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $postal_code = $_POST['postal_code'];
    $address = "$building_number, $street, $barangay, $city, $province, $postal_code";
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $verify_token= md5(rand());

    // Prepare the SELECT statement to check if email exists
    $check_email_query = "SELECT email FROM users WHERE email=? LIMIT 1";
    $stmt = mysqli_prepare($con, $check_email_query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) > 0) {
        $_SESSION['status'] = "Email already exists";
        header("Location: ../register.php");
        exit(); // Make sure to exit after redirection
    } else {
        // Prepare the INSERT statement to register user data
        $query ="INSERT INTO users (fname, lname, email, contact, address, password, verify_token) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sssssss", $fname, $lname, $email, $contact, $address, $hashed_password, $verify_token);
        $query_run = mysqli_stmt_execute($stmt);

        if($query_run) {
            sendemail_verify($fname, $lname, $email, $verify_token);
            $_SESSION['status'] = "Registration Successful! Verify your Email";
            header("Location: ../register.php");
            exit(); // Make sure to exit after redirection
        } else {
            $_SESSION['status'] = "Registration Failed";
            header("Location: ../register.php");
            exit(); // Make sure to exit after redirection
        }
    }
}
?>