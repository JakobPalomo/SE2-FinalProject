<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/navbar.css" />
    <link rel="stylesheet" type="text/css" href="../css/orderlistadmin.css"/>
    <title>orderlistAdmin</title>
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
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <?php include('../common/navbar.php');?>

    <div class="container mt-4">
        <h1 class="display-4 text-center" style="font-weight:bold;">Order List</h1>

        <div class="text-center mt-3">
            <button class="btn btn-sm mx-4 rounded-4 custom-button">Incoming Orders</button>
            <button class="btn btn-sm mx-4 rounded-4 custom-button">Accepted Orders</button>
            <button class="btn btn-sm mx-4 rounded-4 custom-button">Previous Orders</button>
        </div>

         <!-- White boxes with shadow  -->  
         <div class="row mt-5 flex-column align-items-center">
            <div class="col-12 col-md-12 col-lg-7 mb-4">
                <div class="white-box d-flex rounded-4">
                    <div class="box-content p-3 flex-grow-1">
                        <p class="order-number mb-0">Order no. 0001</p>
                        <p class="email mb-0">email@gmail.com</p>
                    </div>
                    <div class="d-flex flex-column align-items-end p-3">
                        <p class="price mb-0">P 1000.0</p>
                        <span class="new-text text-center col-md-12 col-lg-12 mt-2 p-1 rounded-4" style="background-color:#00894D;color: #fff">New</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7 mb-4">
                <div class="white-box d-flex rounded-4">
                    <div class="box-content p-3 flex-grow-1">
                        <p class="order-number mb-0">Order no. 0002</p>
                        <p class="email mb-0">anotheremail@gmail.com</p>
                    </div>
                    <div class="d-flex flex-column align-items-end p-3">
                        <p class="price mb-0">P 1500.0</p>
                        <span class="new-text text-center  col-md-12 col-lg-12 mt-2 p-1 rounded-4" style="background-color:#00894D;color: #fff">New</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
