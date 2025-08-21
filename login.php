<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <!-- Bootstrap -->
    <link href="assets2/css/bootstrap.min.css" rel="stylesheet">
    <!-- icon -->
    <link rel="stylesheet" href="assets2/plugins/BootstrapIcons/font/bootstrap-icons.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets2/plugins/DataTables/datatables.min.css">
    <!-- JQuery -->
    <script src="assets2/js/jquery-3.7.1.min.js"></script>
    <!-- Custom CSS -->
    <style>
        html,
        body {
            font-family: "Nunito", sans-serif;
            font-optical-sizing: auto;
            font-weight: 600;
            font-style: normal;
        }
    </style>
</head>


<body class="bg-light min-vh-100 d-flex flex-column">

    <!-- content -->

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-md-5 border-0 border-top border-3 border-primary shadow rounded-3 p-3 ">
                <h4>Login App</h4>
                <hr>

                <?php
                if (isset($_GET['error']) && $_GET['error'] == 1) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> Username Atau Password Salah!
                    </div>
                <?php } ?>

                <form action="act_log.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <!-- Bootstrap JS -->
    <script src="assets2/js/bootstrap.bundle.min.js"></script>


</body>



</html>