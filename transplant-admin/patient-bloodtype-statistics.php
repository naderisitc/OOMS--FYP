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

        <title>Admin | Patient Blood Type Statistics</title>

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

                            <h2 class="page-title"><font face="Comic Sans MS" color="red">Blood Type Statistics</font></h2>

                            <!-- Zero Configuration Table -->
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

                                        $sql = "SELECT BloodType from  tablekidney WHERE BloodType=:A";
                                        $sqlB = "SELECT BloodType from  tablekidney WHERE BloodType=:B";
                                        $sqlAB = "SELECT BloodType from  tablekidney WHERE BloodType=:AB";
                                        $sqlO = "SELECT BloodType from  tablekidney WHERE BloodType=:O";

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

                                        $kidney = $query->rowCount();
                                        $kidneyB = $queryB->rowCount();
                                        $kidneyAB = $queryAB->rowCount();
                                        $kidneyO = $queryO->rowCount();

                                        //count Heart
                                        $sqlh = "SELECT BloodType from  tableheart WHERE BloodType=:A";
                                        $sqlhB = "SELECT BloodType from  tableheart WHERE BloodType=:B";
                                        $sqlhAB = "SELECT BloodType from  tableheart WHERE BloodType=:AB";
                                        $sqlhO = "SELECT BloodType from  tableheart WHERE BloodType=:O";
                                        //Prepare the query
                                        $queryh = $dbh->prepare($sqlh);
                                        $queryhB = $dbh->prepare($sqlhB);
                                        $queryhAB = $dbh->prepare($sqlhAB);
                                        $queryhO = $dbh->prepare($sqlhO);

                                        //Bind
                                        $queryh->bindValue(':A', $A, PDO::PARAM_STR);
                                        $queryhB->bindValue(':B', $B, PDO::PARAM_STR);
                                        $queryhAB->bindValue(':AB', $AB, PDO::PARAM_STR);
                                        $queryhO->bindValue(':O', $O, PDO::PARAM_STR);

                                        //Execute the query
                                        $queryh->execute();
                                        $queryhB->execute();
                                        $queryhAB->execute();
                                        $queryhO->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultsh = $queryh->fetchAll(PDO::FETCH_OBJ);
                                        $resultshB = $queryhB->fetchAll(PDO::FETCH_OBJ);
                                        $resultshAB = $queryhAB->fetchAll(PDO::FETCH_OBJ);
                                        $resultshO = $queryhO->fetchAll(PDO::FETCH_OBJ);

                                        $heart = $queryh->rowCount();
                                        $heartB = $queryhB->rowCount();
                                        $heartAB = $queryhAB->rowCount();
                                        $heartO = $queryhO->rowCount();

                                        //count Lungs

                                        $sqll = "SELECT BloodType from  tablelungs WHERE BloodType=:A";
                                        $sqllB = "SELECT BloodType from  tablelungs WHERE BloodType=:B";
                                        $sqllAB = "SELECT BloodType from  tablelungs WHERE BloodType=:AB";
                                        $sqllO = "SELECT BloodType from  tablelungs WHERE BloodType=:O";
                                        //Prepare the query
                                        $queryl = $dbh->prepare($sqll);
                                        $querylB = $dbh->prepare($sqllB);
                                        $querylAB = $dbh->prepare($sqllAB);
                                        $querylO = $dbh->prepare($sqllO);
                                        //Bind
                                        $queryl->bindValue(':A', $A, PDO::PARAM_STR);
                                        $querylB->bindValue(':B', $B, PDO::PARAM_STR);
                                        $querylAB->bindValue(':AB', $AB, PDO::PARAM_STR);
                                        $querylO->bindValue(':O', $O, PDO::PARAM_STR);
                                        //Execute the query
                                        $queryl->execute();
                                        $querylB->execute();
                                        $querylAB->execute();
                                        $querylO->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultsl = $queryl->fetchAll(PDO::FETCH_OBJ);
                                        $resultslB = $querylB->fetchAll(PDO::FETCH_OBJ);
                                        $resultslAB = $querylAB->fetchAll(PDO::FETCH_OBJ);
                                        $resultslO = $querylO->fetchAll(PDO::FETCH_OBJ);

                                        $lungs = $queryl->rowCount();
                                        $lungsB = $querylB->rowCount();
                                        $lungsAB = $querylAB->rowCount();
                                        $lungsO = $querylO->rowCount();

                                        //count Liver

                                        $sqlli = "SELECT BloodType from  tableliver WHERE BloodType=:A";
                                        $sqlliB = "SELECT BloodType from  tableliver WHERE BloodType=:B";
                                        $sqlliAB = "SELECT BloodType from  tableliver WHERE BloodType=:AB";
                                        $sqlliO = "SELECT BloodType from  tableliver WHERE BloodType=:O";

                                        //Prepare the query
                                        $queryli = $dbh->prepare($sqlli);
                                        $queryliB = $dbh->prepare($sqlliB);
                                        $queryliAB = $dbh->prepare($sqlliAB);
                                        $queryliO = $dbh->prepare($sqlliO);

                                        //Bind
                                        $queryli->bindValue(':A', $A, PDO::PARAM_STR);
                                        $queryliB->bindValue(':B', $B, PDO::PARAM_STR);
                                        $queryliAB->bindValue(':AB', $AB, PDO::PARAM_STR);
                                        $queryliO->bindValue(':O', $O, PDO::PARAM_STR);
                                        //Execute the query
                                        $queryli->execute();
                                        $queryliB->execute();
                                        $queryliAB->execute();
                                        $queryliO->execute();
                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultsli = $queryli->fetchAll(PDO::FETCH_OBJ);
                                        $resultsliB = $queryliB->fetchAll(PDO::FETCH_OBJ);
                                        $resultsliAB = $queryliAB->fetchAll(PDO::FETCH_OBJ);
                                        $resultsliO = $queryliO->fetchAll(PDO::FETCH_OBJ);

                                        $liver = $queryli->rowCount();
                                        $liverB = $queryliB->rowCount();
                                        $liverAB = $queryliAB->rowCount();
                                        $liverO = $queryliO->rowCount();

                                        //count Eyes

                                        $sqle = "SELECT BloodType from  tableeyes WHERE BloodType=:A";
                                        $sqleB = "SELECT BloodType from  tableeyes WHERE BloodType=:B";
                                        $sqleAB = "SELECT BloodType from  tableeyes WHERE BloodType=:AB";
                                        $sqleO = "SELECT BloodType from  tableeyes WHERE BloodType=:O";
                                        //Prepare the query
                                        $querye = $dbh->prepare($sqle);
                                        $queryeB = $dbh->prepare($sqleB);
                                        $queryeAB = $dbh->prepare($sqleAB);
                                        $queryeO = $dbh->prepare($sqleO);

                                        //Bind
                                        $querye->bindValue(':A', $A, PDO::PARAM_STR);
                                        $queryeB->bindValue(':B', $B, PDO::PARAM_STR);
                                        $queryeAB->bindValue(':AB', $AB, PDO::PARAM_STR);
                                        $queryeO->bindValue(':O', $O, PDO::PARAM_STR);
                                        //Execute the query
                                        $querye->execute();
                                        $queryeB->execute();
                                        $queryeAB->execute();
                                        $queryeO->execute();

                                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                        $resultse = $querye->fetchAll(PDO::FETCH_OBJ);
                                        $resultseB = $queryeB->fetchAll(PDO::FETCH_OBJ);
                                        $resultseAB = $queryeAB->fetchAll(PDO::FETCH_OBJ);
                                        $resultseO = $queryeO->fetchAll(PDO::FETCH_OBJ);

                                        $eyes = $querye->rowCount();
                                        $eyesB = $queryeB->rowCount();
                                        $eyesAB = $queryeAB->rowCount();
                                        $eyesO = $queryeO->rowCount();

                                       //Total 
                                        $BloodA = $kidney + $heart + $lungs + $liver + $eyes;
                                        $BloodB = $kidneyB + $heartB + $lungsB + $liverB + $eyesB;
                                        $BloodAB = $kidneyAB + $heartAB + $lungsAB + $liverAB + $eyesAB;
                                        $BloodO = $kidneyO + $heartO + $lungsO + $liverO + $eyesO;

                                        $total = $BloodA + $BloodB + $BloodAB + $BloodO;
                                        ?>	
                                        <tr> <!-- Display Records -->
                                            <td><?php echo "Number of Patients" ?></td>
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
