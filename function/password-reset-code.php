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

function send_password_reset($get_fname,$get_email,$token)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP();   
    $mail->SMTPAuth   = true;                             

    $mail->Host       = 'smtp.gmail.com';                                    
    $mail->Username   = 'cdemailverify@gmail.com';                    
    $mail->Password   = 'imse cgjh qyzq bwhg';    
    $mail->SMTPSecure ="tls";
      
    $mail->Port       = 587;           
    
    $mail->setFrom("cdemailverify@gmail.com", $get_fname);
    $mail->addAddress($get_email);

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password Notification';

    $email_template = "
    <h2>Password Reset</h2>
 <h5>You are receiving this email because you have requested for a password reset <h5>
 <br/>
 
 <a href ='http://localhost/SE2-FINALPROJECT/password-change.php?token=$token&email=$get_email'>Click Me</a> ";



    $mail->Body = $email_template;
    $mail->send();
    if(!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message has been sent";
    }

}

if(isset($_POST['password_reset_link']))
{
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM users WHERE email = '$email' LIMIT 1  ";
    $check_email_run = mysqli_query($con, $check_email);

    if(mysqli_num_rows( $check_email_run) >0 )
    {
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['name'];
        $get_email = $row['email'];

        $update_token = "UPDATE users SET verify_token = '$token' WHERE email = '$get_email' LIMIT 1";
        $update_token_run = mysqli_query($con, $update_token);

        if($update_token_run)
        {
            send_password_reset($get_name, $get_email, $token);
            $_SESSION['status'] = 'We e-mailed you a password reset link';
            header("Location: ../password-reset.php");
               exit(0);
        }
        else{
            $_SESSION['status'] = 'Something went wrong';
             header("Location: ../password-reset.php");
                exit(0);

        }
    }
    else
    {
        $_SESSION['status'] = 'No Email Found';
        header("Location: ../password-reset.php");
        exit(0);
    }

}

if(isset($_POST['password_update'])) {
    if(!empty($_POST['email']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password']) && !empty($_POST['password_token'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
        $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
        $token = mysqli_real_escape_string($con, $_POST['password_token']);

        // Check if token is valid
        $check_token_query = "SELECT verify_token FROM users WHERE verify_token = ? LIMIT 1";
        $stmt_check_token = mysqli_prepare($con, $check_token_query);
        mysqli_stmt_bind_param($stmt_check_token, "s", $token);
        mysqli_stmt_execute($stmt_check_token);
        mysqli_stmt_store_result($stmt_check_token);

        if(mysqli_stmt_num_rows($stmt_check_token) > 0) {
            // Check if new password matches confirm password
            if($new_password === $confirm_password) {
                // Check password strength
                if (is_strong_password($new_password)) {
                    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                    // Update password and generate new token
                    $update_password_query = "UPDATE users SET password=?, verify_token=? WHERE verify_token=? LIMIT 1";
                    $stmt_update_password = mysqli_prepare($con, $update_password_query);
                    $new_token = md5(rand())."cd";
                    mysqli_stmt_bind_param($stmt_update_password, "sss", $hashed_new_password, $new_token, $token);
                    mysqli_stmt_execute($stmt_update_password);

                    if(mysqli_stmt_affected_rows($stmt_update_password) > 0) {
                        $_SESSION['status'] = "New Password Successfully Updated";
                        header("Location: ../login.php");
                        exit(0);
                    } else {
                        $_SESSION['status'] = "Something went wrong";
                        header("Location: ../password-change.php?token=$token&email=$email");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "Password should be at least 8 characters long and include one uppercase letter, one lowercase letter, and one digit.";
                    header("Location: ../password-change.php?token=$token&email=$email");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Password and Confirm password do not match";
                header("Location: ../password-change.php?token=$token&email=$email");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Invalid Token";
            header("Location: ../password-change.php?token=$token&email=$email");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "All Fields are Mandatory";
        header("Location: ../password-change.php?token=$token&email=$email");
        exit(0);
    }
}

function is_strong_password($password) {
    // Add your password strength criteria here
    $length = strlen($password) >= 8;
    $uppercase = preg_match('/[A-Z]/', $password);
    $lowercase = preg_match('/[a-z]/', $password);
    $digit = preg_match('/\d/', $password);

    return $length && $uppercase && $lowercase && $digit;
}
?>


