<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/navbar.css" />
    <link rel="stylesheet" type="text/css" href="../css/notifications.css" />
    <title>Notifications</title>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <script src="https://kit.fontawesome.com/811a7f7c23.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
      rel="stylesheet"
    />
  </head>
  <body style="background-color: #f5f5dc">
    <?php include('../common/navbar.php');?>

    <div class="container mt-5">
    <div class="row">
        <div class="col-md-3 offset-md-4">
                <!-- First Box -->
                <div class="shadow mb-5 p-3 bg-white rounded-4 text-black text-center"><i class="fa-regular fa-bell float-start"></i>New Order Placed <i class="fa-solid fa-1 float-end"></i></div>
                <!-- Second Box -->
                <div class="shadow mb-5 p-3 bg-white rounded-4 text-black text-center">
                  <i class="fa-regular fa-bell float-start"></i>Order is Declined <i class="fa-solid fa-circle-xmark float-end"></i>
                  <p class="small text-muted">REASON: the item is not available</p>
                </div>
                <!-- Third Box -->
                <div class="shadow mb-5 p-3 bg-white rounded-4 text-black text-center"><i class="fa-regular fa-bell float-start"></i>Order is Accepted <i class="fa-solid fa-circle-check float-end"></i></div>
                <!-- Fourth Box -->
                <div class="shadow p-3 bg-white rounded-4 text-black text-center"><i class="fa-regular fa-bell float-start"></i>Delivery on the way <i class="fa-solid fa-motorcycle float-end"></i></div>
            
        </div>
    </div>
    </div>
  </body>
</html> 