<?php 
session_start();
$page_title ="Password Reset";
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
                            <h5> Change Password </h5>
                        </div>
                        <div class="card-body">
                            <form action ="./function/password-reset-code.php" method ="POST">
                                <input type = "hidden" name ="password_token" value ="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>">
                                <div class="form-group mb-3">
                                    <label>Email Address</label>
                                    <input type ="text" name ="email" class = "form-control" value ="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" placeholder ="Enter Email Address">
                                </div>
                                <div class="form-group mb-3">
                                    <label>New Password</label>
                                    <input type ="password" name ="new_password" class = "form-control" placeholder ="Enter New Password">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Confirm Password</label>
                                    <input type ="password" name ="confirm_password" class = "form-control" placeholder ="Confirm New Password">
                                </div>
                                <div class="form-group mb-3">
                                <button type ="submit" name ="password_update" class = "btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>


