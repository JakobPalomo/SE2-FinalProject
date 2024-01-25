<?php 
session_start();
include('common/navbar.php');?>

<div class="py-5">
    <div class="container">
        <div class = "justify-content-center">
                 <div class="col-md-6">
                 <?php
                    if(isset($_SESSION['status']))
                    {
                        echo"<h4>" .$_SESSION['status']."<h4>";
                        unset($_SESSION['status']); 
                    }
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h5> Reset Password </h5>
                        </div>
                        <div class="card-body">
                            <form action ="./function/password-reset-code.php" method ="POST">
                                <div class="form-group mb-3">
                                    <label>Email Address</label>
                                    <input type ="text" name ="email" class = "form-control" placeholder ="Enter Email Address">
                                </div>
                                <div class="form-group mb-3">
                                <button type ="submit" name ="password_reset_link" class = "btn btn-primary">Send Pasword Reset Link</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

