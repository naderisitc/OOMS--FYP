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

        <title>Admin | Patient Organ Statistics</title>

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

                            <h2 class="page-title"><font face="Comic Sans MS" color="red">Organ Statistics</font></h2>

                            <!-- Zero Configuration Table -->
                            <div class="panel panel-default">
                                <div class="panel-heading" style="color: green;">Statistics by Organ Name</div>

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
                                        //Count Kidney
                                        $sql = "SELECT id from  tablekidney";
                                        //Prepare the query
                                        $query = $dbh->prepare($sql);
                                        //Execute the query
                                        $query->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $kidney = $query->rowCount();

                                        //count Heart
                                        $sqlh = "SELECT id from  tableheart";
                                        //Prepare the query
                                        $queryh = $dbh->prepare($sqlh);
                                        //Execute the query
                                        $queryh->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultsh = $queryh->fetchAll(PDO::FETCH_OBJ);
                                        $heart = $queryh->rowCount();
                                        //count Lungs

                                        $sqll = "SELECT id from  tablelungs";
                                        //Prepare the query
                                        $queryl = $dbh->prepare($sqll);
                                        //Execute the query
                                        $queryl->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultsl = $queryl->fetchAll(PDO::FETCH_OBJ);
                                        $lungs = $queryl->rowCount();

                                        //count Liver
                                        $sqlli = "SELECT id from  tableliver";
                                        //Prepare the query
                                        $queryli = $dbh->prepare($sqlli);
                                        //Execute the query
                                        $queryli->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultsli = $queryli->fetchAll(PDO::FETCH_OBJ);
                                        $liver = $queryli->rowCount();

                                        //countPancreas
                                        $sqle = "SELECT id from  tablepancreas";
                                        //Prepare the query
                                        $querye = $dbh->prepare($sqle);
                                        //Execute the query
                                        $querye->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultse = $querye->fetchAll(PDO::FETCH_OBJ);
                                        $pancreas = $querye->rowCount();

                                        //Total
                                        $total = $kidney + $heart + $lungs + $liver + $pancreas;
                                        ?>	
                                        <tr> <!-- Display Records -->
                                            <td><?php echo "Number of Patients" ?></td>
                                            <td><?php echo htmlentities($kidney); ?></td>
                                            <td><?php echo htmlentities($heart); ?></td>
                                            <td><?php echo htmlentities($lungs); ?></td>
                                            <td><?php echo htmlentities($liver); ?></td>
                                            <td><?php echo htmlentities($pancreas); ?></td>
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
