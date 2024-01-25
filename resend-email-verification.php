<?php 
session_start();


include('./common/navbar.php');?>

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
                            <h5> Resend Email Verification </h5>
                        </div>
                        <div class="card-body">
                            <form action ="./function/resend-code.php" method ="POST">
                                <div class="form-group mb-3">
                                    <label>Email Address</label>
                                    <input type ="text" name ="email" class = "form-control" placeholder ="Enter Email Address">
                                </div>
                                <div class="form-group mb-3">
                                <button type ="submit" name ="resend_email_verify_btn" class = "btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>


