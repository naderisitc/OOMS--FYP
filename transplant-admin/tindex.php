<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT UserName,Password FROM tableadmin WHERE UserName=:username and PassWord=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['tlogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location = 'tdashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Username or Password. Please try again.');</script>";
    }
}
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>OOMS | Transplant Log In</title>
        <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Main Bootstrap -->
        <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">   <!-- Bootstrap Data tables --> 
        <link rel="stylesheet" href="css/style.css"> <!-- Header Stye -->

    </head>
    <body>

        <div class="login-page bk-img" style="background-image: url(images/transplant.jpg);">
            <div class="form-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-md-offset-7">
                            <h1 class="text-bold mt-3x" style="color:red;">Transplant Admin Sign In</h1>
                            <div class="well row pt-2x pb-3x bk-white">
                                <div class="col-md-8 col-md-offset-2">
                                    <img src="images/ts-avatar.jpg" class="img-circle center-block"  alt="" style="width: 50%"><br>
                                    <form method="post">

                                        <div  class="fa fa-user-md text-primary text-bold"><font face="Trebuchet MS" style="font-size:14px;"><b> USERNAME</b></font></div>
                                        <input type="text" placeholder="Enter your username" name="username" class="form-control mb" required>

                                        <div  class="fa fa-lock text-primary text-bold"><font face="Trebuchet MS" style="font-size:14px;"><b> PASSWORD</b></font></div>
                                        <input type="password" placeholder="Enter your password" name="password" class="form-control mb" required>

                                        <button class="btn btn-primary btn-block" name="login" type="submit"><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;<b>LOGIN</b></font></button>
                                        <br><a href="forget-password.php" class="text-uppercase text-sm">Forgot Password/Username</a>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>