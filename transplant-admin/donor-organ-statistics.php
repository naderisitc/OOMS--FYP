<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['tlogin']) == 0) {
    header('location:tindex.php');
}
?>

<!doctype html>
<html lang="en">

    <head>
         <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

        <title>Admin | Donor Organ Statistics</title>

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

                            <h2 class="page-title"><font face="Comic Sans MS" color="red">Donor Organ Statistics</font></h2>

                            <!-- Zero Configuration Table -->
                            <div class="panel panel-default">
                                <div class="panel-heading" style="color: green;" >Statistics by Organ Name</div>

                                <table  class="display table table-striped table-bordered table-hover" width="100%">

                                    <thead>
                                        <tr>
                                            <th style="color:red;">Organ Name</th>
                                            <th style="color:blue;">Kidney</th>
                                            <th style="color:blue;">Heart</th>
                                            <th style="color:blue;">Lungs</th>
                                            <th style="color:blue;">Liver</th>
                                            <th style="color:blue;">Pancreas</th>
                                            <th style="color:red;">Total</th>                                                  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $kidney = "Kidney";
                                        $heart = "Heart";
                                        $lungs = "Lungs";
                                        $liver = "Liver";
                                        $pancreas = "Pancreas";

                                        //Count Kidney
                                        $sql = "SELECT OrganDonated from  tableorgandonors Where OrganDonated=:kidney ";
                                        //Prepare the query
                                        $query = $dbh->prepare($sql);
                                        //Bind
                                        $query->bindValue(':kidney', $kidney, PDO::PARAM_STR);
                                        //Execute the query
                                        $query->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $kidneyN = $query->rowCount();
                                        //count Heart
                                        $sqlh = "SELECT OrganDonated2 from  tableorgandonors Where OrganDonated2=:heart ";
                                        //Prepare the query
                                        $queryh = $dbh->prepare($sqlh);
                                        //Bind
                                        $queryh->bindValue(':heart', $heart, PDO::PARAM_STR);
                                        //Execute the query
                                        $queryh->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultsh = $queryh->fetchAll(PDO::FETCH_OBJ);
                                        $heartN = $queryh->rowCount();

                                        //count Lungs
                                        $sqll = "SELECT OrganDonated3 from  tableorgandonors WHERE OrganDonated3=:lungs";
                                        //Prepare the query
                                        $queryl = $dbh->prepare($sqll);
                                        //bind
                                        $queryl->bindValue(':lungs', $lungs, PDO::PARAM_STR);
                                        //Execute the query
                                        $queryl->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultsl = $queryl->fetchAll(PDO::FETCH_OBJ);
                                        $lungsN = $queryl->rowCount();

                                        //count Liver
                                        $sqlli = "SELECT OrganDonated4 from  tableorgandonors Where OrganDonated4=:liver";
                                        //Prepare the query
                                        $queryli = $dbh->prepare($sqlli);
                                        //bind
                                        $queryli->bindValue(':liver', $liver, PDO::PARAM_STR);
                                        //Execute the query
                                        $queryli->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultsli = $queryli->fetchAll(PDO::FETCH_OBJ);
                                        $liverN = $queryli->rowCount();

                                        //count Pancreas
                                        $sqle = "SELECT OrganDonated5 from  tableorgandonors Where OrganDonated5=:pancreas ";
                                        //Prepare the query
                                        $querye = $dbh->prepare($sqle);
                                        //bind
                                        $querye->bindValue(':pancreas', $pancreas, PDO::PARAM_STR);
                                        //Execute the query
                                        $querye->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultse = $querye->fetchAll(PDO::FETCH_OBJ);
                                        $pancreasN = $querye->rowCount();
                                        //Total
                                        $total = $kidneyN + $heartN + $lungsN + $liverN + $pancreasN;
                                        ?>	
                                        <tr> <!-- Display Records -->
                                            <td><?php echo "Number of Donors" ?></td>
                                            <td><?php echo htmlentities($kidneyN); ?></td>
                                            <td><?php echo htmlentities($heartN); ?></td>
                                            <td><?php echo htmlentities($lungsN); ?></td>
                                            <td><?php echo htmlentities($liverN); ?></td>
                                            <td><?php echo htmlentities($pancreasN); ?></td>
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
<?php
