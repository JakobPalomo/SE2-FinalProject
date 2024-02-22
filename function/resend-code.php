<?php
session_start();
include('../dbcon.php');


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require '../vendor/autoload.php';

function resend_email_verify($name,$email,$verify_token)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP();   
    $mail->SMTPAuth   = true;                             

    $mail->Host       = 'smtp.gmail.com';                                    
    $mail->Username   = 'cdemailverify@gmail.com';                    
    $mail->Password   = 'imse cgjh qyzq bwhg';    
    $mail->SMTPSecure ="tls";
      
    $mail->Port       = 587;           
    
    $mail->setFrom("cdemailverify@gmail.com", "Chef's Daughter");
    $mail->addAddress($email);

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Resend Email Verification';

    $email_template = "<h1>Account Verified</h1>
    <h2>Your account has been verified!</h2>
 <h5>You can now use Chef's Daughter Website<h5>
 <br/>
 <a href ='http://localhost/SE2-FINALPROJECT/function/verify-email.php?token=$verify_token'>CLICK ME PLEASE DO IT</a>";


    $mail->Body = $email_template;
  
    if(!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message has been sent";
    }
    
    
}

if(isset($_POST['resend_email_verify_btn']))
{
    if(!empty(trim($_POST['email'])))
    {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $checkmail_query = "SELECT * FROM USERS WHERE email  ='$email' LIMIT 1";
        $checkemail_query_run = mysqli_query($con, $checkmail_query);
        if(mysqli_num_rows($checkemail_query_run)>0)
        {
            $row = mysqli_fetch_array($checkemail_query_run);
            if($row['verify_status']=="0")
            {
                $name = $row['name'];
                $email = $row['email'];
                $verify_token = $row['verify_token'];
                resend_email_verify($name,$email,$verify_token);

                $_SESSION['status'] = "Verification Email Link has been sent to your email address";
            header("Location: ../login.php");
            exit(0);
            }
            else{
                $_SESSION['status'] = "You are already verified";
            header("Location: ../login.php");
            exit(0);

            }

        }
        else
        {
            $_SESSION['status'] = "Email is not registered";
            header("Location: ../register.php");
            exit(0);
        }

    }
    else
    {
        $_SESSION['status'] = "Please enter your email";
        header("Location: ../resend-email-verification.php");
        exit(0);
    }
}
?>