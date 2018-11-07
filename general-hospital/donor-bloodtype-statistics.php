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

        <title>General Hospital | Donor Blood Type Statistics</title>

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

                            <h2 class="page-title"><font face="Comic Sans MS" color="red">Donor Blood Type Statistics</font></h2>

                            <div class="panel panel-default">
                                <div class="panel-heading" style="color: green;">Statistics by Blood Type</div>

                                <table id="izcb" class="display table table-striped table-bordered table-hover" width="100%">

                                    <thead>
                                        <tr>
                                            <th style="color:red;">Blood Type</th>
                                            <th style="color:blue;">A</th>
                                            <th style="color:blue;">B</th>
                                            <th style="color:blue;">AB</th>
                                            <th style="color:blue;">O</th>
                                            <th style="color:red;">Total</th>                                                  
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php
                                        //Count Kidney
                                        $A = "A";
                                        $B = "B";
                                        $AB = "AB";
                                        $O = "O";

                                        $sql = "SELECT BloodType from  tableorgandonors WHERE BloodType=:A";
                                        $sqlB = "SELECT BloodType from  tableorgandonors WHERE BloodType=:B";
                                        $sqlAB = "SELECT BloodType from  tableorgandonors WHERE BloodType=:AB";
                                        $sqlO = "SELECT BloodType from  tableorgandonors WHERE BloodType=:O";
                                        //Prepare the query
                                        $query = $dbh->prepare($sql);
                                        $queryB = $dbh->prepare($sqlB);
                                        $queryAB = $dbh->prepare($sqlAB);
                                        $queryO = $dbh->prepare($sqlO);
                                        //Bind
                                        $query->bindValue(':A', $A, PDO::PARAM_STR);
                                        $queryB->bindValue(':B', $B, PDO::PARAM_STR);
                                        $queryAB->bindValue(':AB', $AB, PDO::PARAM_STR);
                                        $queryO->bindValue(':O', $O, PDO::PARAM_STR);
                                        //Execute the query
                                        $query->execute();
                                        $queryB->execute();
                                        $queryAB->execute();
                                        $queryO->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $resultsB = $queryB->fetchAll(PDO::FETCH_OBJ);
                                        $resultsAB = $queryAB->fetchAll(PDO::FETCH_OBJ);
                                        $resultsO = $queryO->fetchAll(PDO::FETCH_OBJ);

                                        $BloodA = $query->rowCount();
                                        $BloodB = $queryB->rowCount();
                                        $BloodAB = $queryAB->rowCount();
                                        $BloodO = $queryO->rowCount();

                                        //Total 
                                        $total = $BloodA + $BloodB + $BloodAB + $BloodO;
                                        ?>	
                                        <tr> <!-- Display Records -->
                                            <td><?php echo "Number of Donors" ?></td>
                                            <td><?php echo htmlentities($BloodA); ?></td>
                                            <td><?php echo htmlentities($BloodB); ?></td>
                                            <td><?php echo htmlentities($BloodAB); ?></td>
                                            <td><?php echo htmlentities($BloodO); ?></td>
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
