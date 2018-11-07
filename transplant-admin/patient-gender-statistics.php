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

        <title>Admin | Patient Gender Statistics</title>

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

                            <h2 class="page-title"><font face="Comic Sans MS" color="red">Gender Statistics</font></h2>

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
                                        $sqlKM = "SELECT Gender from  tablekidney where Gender=:male";
                                        $sqlKF = "SELECT Gender from  tablekidney where Gender=:female";

                                        $sqlHM = "SELECT Gender from  tableheart where Gender=:male";
                                        $sqlHF = "SELECT Gender from  tableheart where Gender=:female";

                                        $sqlLUM = "SELECT Gender from  tablelungs where Gender=:male";
                                        $sqlLUF = "SELECT Gender from  tablelungs where Gender=:female";

                                        $sqlLIM = "SELECT Gender from  tableliver where Gender=:male";
                                        $sqlLIF = "SELECT Gender from  tableliver where Gender=:female";

                                        $sqlEM = "SELECT Gender from  tableeyes where Gender=:male";
                                        $sqlEF = "SELECT Gender from  tableeyes where Gender=:female";

                                        //Prepare the query
                                        $queryKM = $dbh->prepare($sqlKM); //Kidney male
                                        $queryKF = $dbh->prepare($sqlKF); //Kidney female

                                        $queryHM = $dbh->prepare($sqlHM); //Heart male
                                        $queryHF = $dbh->prepare($sqlHF); //Heart female

                                        $queryLUM = $dbh->prepare($sqlLUM); //Lungs male
                                        $queryLUF = $dbh->prepare($sqlLUF); //Lungs female

                                        $queryLIM = $dbh->prepare($sqlLIM); //Liver male
                                        $queryLIF = $dbh->prepare($sqlLIF); //Liver female

                                        $queryEM = $dbh->prepare($sqlEM); //Lungs male
                                        $queryEF = $dbh->prepare($sqlEF); //Lungs female
                                        // Bind

                                        $queryKM->bindValue(':male', $male, PDO::PARAM_STR);
                                        $queryKF->bindValue(':female', $female, PDO::PARAM_STR);

                                        $queryHM->bindValue(':male', $male, PDO::PARAM_STR);
                                        $queryHF->bindValue(':female', $female, PDO::PARAM_STR);

                                        $queryLUM->bindValue(':male', $male, PDO::PARAM_STR);
                                        $queryLUF->bindValue(':female', $female, PDO::PARAM_STR);

                                        $queryLIM->bindValue(':male', $male, PDO::PARAM_STR);
                                        $queryLIF->bindValue(':female', $female, PDO::PARAM_STR);

                                        $queryEM->bindValue(':male', $male, PDO::PARAM_STR);
                                        $queryEF->bindValue(':female', $female, PDO::PARAM_STR);

                                        //Execute the query
                                        $queryKM->execute();
                                        $queryKF->execute();

                                        $queryHM->execute();
                                        $queryHF->execute();

                                        $queryLUM->execute();
                                        $queryLUF->execute();

                                        $queryLIM->execute();
                                        $queryLIF->execute();

                                        $queryEM->execute();
                                        $queryEF->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultsKM = $queryKM->fetchAll(PDO::FETCH_OBJ);
                                        $resultsKF = $queryKF->fetchAll(PDO::FETCH_OBJ);

                                        $resultsHM = $queryHM->fetchAll(PDO::FETCH_OBJ);
                                        $resultsHF = $queryHF->fetchAll(PDO::FETCH_OBJ);

                                        $resultsLUM = $queryLUM->fetchAll(PDO::FETCH_OBJ);
                                        $resultsLUF = $queryLUF->fetchAll(PDO::FETCH_OBJ);

                                        $resultsLIM = $queryLIM->fetchAll(PDO::FETCH_OBJ);
                                        $resultsLIF = $queryLIF->fetchAll(PDO::FETCH_OBJ);

                                        $resultsEM = $queryEM->fetchAll(PDO::FETCH_OBJ);
                                        $resultsEF = $queryEF->fetchAll(PDO::FETCH_OBJ);
                                        //COunt
                                        $maleKMNo = $queryKM->rowCount();
                                        $femaleKFNo = $queryKF->rowCount();

                                        $maleHMNo = $queryHM->rowCount();
                                        $femaleHFNo = $queryHF->rowCount();

                                        $maleLUMNo = $queryLUM->rowCount();
                                        $femaleLUFNo = $queryLUF->rowCount();

                                        $maleLIMNo = $queryLIM->rowCount();
                                        $femaleLIFNo = $queryLIF->rowCount();

                                        $maleEMNo = $queryEM->rowCount();
                                        $femaleEFNo = $queryEF->rowCount();

                                        //Total
                                        $totalMale = $maleKMNo + $maleHMNo + $maleLUMNo + $maleLIMNo + $maleEMNo;
                                        $totalFemale = $femaleKFNo + $femaleHFNo + $femaleLUFNo + $femaleLIFNo + $femaleEFNo;

                                        $total = $totalMale + $totalFemale;
                                        ?>	
                                        <tr> <!-- Display Records -->
                                            <td><?php echo "Number of Patients" ?></td>
                                            <td><?php echo htmlentities($totalMale); ?></td>
                                            <td><?php echo htmlentities($totalFemale); ?></td>
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
