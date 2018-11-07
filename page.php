<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>OOMS</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/modern-business.css" rel="stylesheet">

        <!-- Temporary navbar container fix -->
        <style>
            .navbar-toggler {
                z-index: 1;
            }

            @media (max-width: 576px) {
                nav > .container {
                    width: 100%;
                }
            }
        </style>
    </head>

    <body>

        <?php include('includes/header.php'); ?>
        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php
                    $pagetype = $_GET['type'];
                    $sql = "SELECT detail,PageName,type from tablepage where type=:pagetype";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                            ?>
                            <h1 class="mt-4 mb-3"><?php echo htmlentities($result->PageName); ?> </h1>

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active"><?php echo htmlentities($result->PageName); ?></li>
                            </ol>

                            <div class="jumbotron">
                                <p><?php echo $result->detail; ?> </p>
                            </div>
                        </div>

                <div class="col-lg-4">   
                            <img class="img-fluid rounded" src="images/banner5.jpg" alt=""><br>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="jumbotron">
                                        <h4> Sign Up As A Donor</h4>
                                        <p>Take a few minutes to sign up online and leave behind the gift of life.</p>
                                        <a href="become-donor.php">Register here (Deceased Donor)</a><br>
                                        <a href="contact.php">Register here (Living Donor)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container -->
            <?php }
        }
        ?>

        <!-- Footer -->
<?php include('includes/footer.php'); ?>

        <!-- Bootstrap core Java Script -->
        <script src="js/vendor/jquery.min.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>

    </body>

</html>
