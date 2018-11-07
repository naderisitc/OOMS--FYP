<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:hindex.php');
}
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>General Hospital | Donor Gender Statistics</title>

        <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Main Bootstrap -->
        <link rel="stylesheet" href="css/style.css"> <!-- Header Stye -->

    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <div class="ts-main-content">
            <?php include('includes/leftbar.php'); ?>
            <div class="content-wrapper">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-10">

                            <h2 class="page-title"><font face="Comic Sans MS" color="red">Donor Gender Statistics</font></h2>

                            <!-- Zero Configuration Table -->
                            <div class="panel panel-default">
                                <div class="panel-heading" style="color: green;">Statistics by Gender</div>

                                <table  class="display table table-striped table-bordered table-hover" width="100%">

                                    <thead>
                                        <tr>
                                            <th style="color:red;">Gender</th>
                                            <th style="color:blue;">Male</th>
                                            <th style="color:blue;">Female</th>
                                            <th style="color:red;">Total</th>                                                  
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $male = "Male";
                                        $female = "Female";
                                        //Count male
                                        $sqlKM = "SELECT Gender from  tableorgandonors where Gender=:male";
                                        $sqlKF = "SELECT Gender from  tableorgandonors where Gender=:female";

                                        //Prepare the query
                                        $queryKM = $dbh->prepare($sqlKM); //Kidney male
                                        $queryKF = $dbh->prepare($sqlKF); //Kidney female
                                        // Bind
                                        $queryKM->bindValue(':male', $male, PDO::PARAM_STR);
                                        $queryKF->bindValue(':female', $female, PDO::PARAM_STR);
                                        //Execute the query
                                        $queryKM->execute();
                                        $queryKF->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultsKM = $queryKM->fetchAll(PDO::FETCH_OBJ);
                                        $resultsKF = $queryKF->fetchAll(PDO::FETCH_OBJ);
                                        //Count
                                        $maleKMNo = $queryKM->rowCount();
                                        $femaleKFNo = $queryKF->rowCount();
                                        //Total
                                        $total = $maleKMNo + $femaleKFNo;
                                        ?>	
                                        <tr> <!-- Display Records -->
                                            <td><?php echo "Number of Donors" ?></td>
                                            <td><?php echo htmlentities($maleKMNo); ?></td>
                                            <td><?php echo htmlentities($femaleKFNo); ?></td>
                                            <td><?php echo htmlentities($total); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>

