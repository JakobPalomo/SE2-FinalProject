<?php
session_start();
include('../dbcon.php');

if (isset($_POST['login_now_btn'])) {
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Check admin table
        $admin_query = "SELECT * FROM admin WHERE username = '$email' LIMIT 1";
        $admin_query_run = mysqli_query($con, $admin_query);

        if (mysqli_num_rows($admin_query_run) > 0) {
            $admin_row = mysqli_fetch_array($admin_query_run);
            if (md5($password) == $admin_row['password']) {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user'] = [
                    'id' => $admin_row['id'],
                    'username' => $admin_row['username'],
                    // Add other admin fields as needed
                ];

                header("Location: ../admin/insert-product.php");
                exit(0);
            } else {
                $_SESSION['status'] = "Invalid Password";
                header("Location: ../login.php");
                exit(0);
            }
        }

        // If no match in admin table, check users table
        $user_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $user_query_run = mysqli_query($con, $user_query);

        if (mysqli_num_rows($user_query_run) > 0) {
            $user_row = mysqli_fetch_array($user_query_run);
            if (password_verify($password, $user_row['password']) && $user_row['verify_status'] == "1") {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user'] = [
                    'id' => $user_row['id'],
                    'fname' => $user_row['fname'],
                    'lname' => $user_row['lname'],
                    'email' => $user_row['email'],
                    'contact' => $user_row['contact'],
                    'address' => $user_row['contact'],
                ];

                if ($_SESSION['status'] = "Logged in Successfully") {
                    header("Location: ../index.php");
                    exit(0);
                } 
            } else {
                $_SESSION['status'] = "Account Not Verified";
                header("Location: ../login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Invalid Email or Password";
            header("Location: ../login.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "All Fields are Mandatory";
        header("Location: ../login.php");
        exit(0);
    }
}
?>
