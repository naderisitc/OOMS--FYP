<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:hindex.php');
} else {
    if (isset($_POST['update'])) {
        // Get the userid
        $userid = intval($_GET['Donor_id']);
        // Posted Values
        $fullname = $_POST['fullname'];
        $passport = $_POST['pass'];
        $nationality = $_POST['nationality'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $state = $_POST['state'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $bloodtype = $_POST['bloodtype'];
        $address = $_POST['address'];
        $organ1 = $_POST['organ1'];
        $organ2 = $_POST['organ2'];
        $organ3 = $_POST['organ3'];
        $organ4 = $_POST['organ4'];
        $organ5 = $_POST['organ5'];

        if (!empty($_POST['organ1']) || !empty($_POST['organ2']) || !empty($_POST['organ3']) || !empty($_POST['organ4']) || !empty($_POST['organ5'])) {

            // Query for Updation
            $sql = "UPDATE tableorgandonors SET FullName=:fullname,Passport=:passport,Nationality=:nationality, MobileNumber=:mobile,Email=:email,State=:state,Gender=:gender,DateOfBirth=:dob,BloodType=:bloodtype,Address=:address,OrganDonated=:organ1,OrganDonated2=:organ2,OrganDonated3=:organ3,OrganDonated4=:organ4,OrganDonated5=:organ5 WHERE Donor_id=:uid ";
            //Prepare Query for Execution
            $query = $dbh->prepare($sql);
            // Bind the parameters
            $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $query->bindParam(':passport', $passport, PDO::PARAM_STR);
            $query->bindParam(':nationality', $nationality, PDO::PARAM_STR);
            $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':state', $state, PDO::PARAM_STR);
            $query->bindParam(':gender', $gender, PDO::PARAM_STR);
            $query->bindParam(':dob', $dob, PDO::PARAM_STR);
            $query->bindParam(':bloodtype', $bloodtype, PDO::PARAM_STR);
            $query->bindParam(':address', $address, PDO::PARAM_STR);
            $query->bindParam(':uid', $userid, PDO::PARAM_STR);
            $query->bindParam(':organ1', $organ1, PDO::PARAM_STR);
            $query->bindParam(':organ2', $organ2, PDO::PARAM_STR);
            $query->bindParam(':organ3', $organ3, PDO::PARAM_STR);
            $query->bindParam(':organ4', $organ4, PDO::PARAM_STR);
            $query->bindParam(':organ5', $organ5, PDO::PARAM_STR);

            // Query Execution
            $query->execute();

// Mesage after updation
            echo "<script>alert(' Donor information updated successfully.');</script>";
// Code for redirection
            echo "<script>window.location.href='donor-list.php'</script>";
        } else {
            echo "<script>alert('Please select at least one organ to be donated by the donor!');</script>";
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

            <title>Admin | Update Donor Info</title>

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
                            <div class="col-md-12">

                                <h2 class="page-title"><font face="Comic Sans MS" color="red">Update Donor Info</font></h2>

                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Form fields</div>
                                            <div class="panel-body">

                                                <form method="post"  class="form-horizontal">
                                                    <?php
                                                    // Get the userid
                                                    $userid = intval($_GET['Donor_id']);
                                                    $sql = "SELECT FullName,Passport,Nationality,MobileNumber,Email,State,Gender,DateOfBirth,BloodType,Address,OrganDonated,OrganDonated2,OrganDonated3,OrganDonated4,OrganDonated5,Donor_id from tableorgandonors where Donor_id=:uid";
                                                    //Prepare the query:
                                                    $query = $dbh->prepare($sql);
                                                    //Bind the parameters
                                                    $query->bindParam(':uid', $userid, PDO::PARAM_STR);
                                                    //Execute the query:
                                                    $query->execute();
                                                    //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    // For serial number initialization
                                                    $cnt = 1;
                                                    if ($query->rowCount() > 0) {
                                                        //In case that the query returned at least one record, we can echo the records within a foreach loop:
                                                        foreach ($results as $result) {
                                                            ?> 
                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label">Full Name<span style="color:red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="fullname" class="form-control" value="<?php echo htmlentities($result->FullName); ?>" title="Patient name can contain letters only" pattern="[a-zA-Z\s]+" maxLength="25" required>
                                                                </div>
                                                                <label class="col-sm-2 control-label">IC/Passport No.<span style="color:red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="pass" class="form-control" value="<?php echo htmlentities($result->Passport); ?>" maxlength="12" placeholder="Enter your IC/Passport No."  required>                                                                                        </div>                                                                                    
                                                            </div>

                                                            <div class="form-group">

                                                                <label class="col-sm-2 control-label">Nationality<span style="color:red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <select name="nationality" class="form-control"  required>
                                                                        <option value="">---Select---</option>
                                                                        <option value="Malaysian" <?php
                                                                        if ($result->Nationality == "Malaysian") {
                                                                            echo "selected";
                                                                        }
                                                                        ?>>Malaysian</option>
                                                                        <option value="Permanent Resident" <?php
                                                                        if ($result->Nationality == "Permanent Resident") {
                                                                            echo "selected";
                                                                        }
                                                                        ?> >Permanent Resident</option>
                                                                        <option value="Non-Malaysian" <?php
                                                                    if ($result->Nationality == "Non-Malaysian") {
                                                                        echo "selected";
                                                                    }
                                                                    ?>>Non-Malaysian</option>
                                                                    </select>
                                                                </div>
                                                                <label class="col-sm-2 control-label">Mobile Number<span style="color:red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" maxlength="14"  name="mobile" class="form-control"  value="<?php echo htmlentities($result->MobileNumber); ?>" placeholder="Enter only 14 numeric values" class="form-control" pattern="[0-9]{14}" maxlength="14" title="Remove any characters/spaces/negative numbers. Enter numbers only, e.g. 00601113328804" required>
                                                                </div>                                                                                    
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <input type="email" name="email" value="<?php echo htmlentities($result->Email); ?>" class="form-control" required>
                                                                </div>

                                                                <label class="col-sm-2 control-label">Date of Birth<span style="color:red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <input type="date" name="dob" min="1930-01-01" max="2018-05-25" value="<?php echo htmlentities($result->DateOfBirth); ?>" class="form-control" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label">Organ(s) To Donate <span style="color:red">*</span> </label>
                                                                <div class="col-sm-5" required>    
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox"  name="organ1" value="Kidney" <?php
                                                                    if ($result->OrganDonated == "Kidney") {
                                                                        echo "checked";
                                                                    }
                                                                        ?> >Kidney</label>
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox"  name="organ2" value="Heart" <?php
                                                                        if ($result->OrganDonated2 == "Heart") {
                                                                            echo "checked";
                                                                        }
                                                                        ?>  >Heart</label>
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" name="organ3" value="Lungs" <?php
                                                                        if ($result->OrganDonated3 == "Lungs") {
                                                                            echo "checked";
                                                                        }
                                                                        ?>  >Lungs</label>
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" name="organ4" value="Liver" <?php
                                                                        if ($result->OrganDonated4 == "Liver") {
                                                                            echo "checked";
                                                                        }
                                                                        ?> >Liver</label>
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" name="organ5" value="Pancreas" <?php
                                                                        if ($result->OrganDonated5 == "Pancreas") {
                                                                            echo "checked";
                                                                        }
                                                                        ?> >Pancreas</label>              
                                                                </div>  
                                                                <label class="col-sm-1 control-label">Blood Type<span style="color:red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <select name="bloodtype" class="form-control"  required>
                                                                        <option value="">---Select---</option>
                                                                        <option value="A" <?php
                                                                        if ($result->BloodType == "A") {
                                                                            echo "selected";
                                                                        }
                                                                        ?> >A</option>
                                                                        <option value="B" <?php
                                                                        if ($result->BloodType == "B") {
                                                                            echo "selected";
                                                                        }
                                                                        ?> >B</option>
                                                                        <option value="AB" <?php
                                                                        if ($result->BloodType == "AB") {
                                                                            echo "selected";
                                                                        }
                                                                        ?> >AB</option>
                                                                        <option value="O" <?php
                                                                                if ($result->BloodType == "O") {
                                                                                    echo "selected";
                                                                                }
                                                                                ?> >O</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label">State<span style="color:red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <select name="state" class="form-control"  required>
                                                                        <option value="">---Select---</option>
                                                                        <option value="Johor" <?php
                                                                        if ($result->State == "Johor") {
                                                                            echo "selected";
                                                                        }
                                                                        ?> >Johor</option>
                                                                        <option value="Kedah"  <?php
                                                                        if ($result->State == "Kedah") {
                                                                            echo "selected";
                                                                        }
                                                                        ?>>Kedah</option>
                                                                        <option value="Kelantan" <?php
                                                                                if ($result->State == "Kelantan") {
                                                                                    echo "selected";
                                                                                }
                                                                                ?>>Kelantan</option>
                                                                        <option value="Kuala Lumpur" <?php
                                                                        if ($result->State == "Kuala Lumpur") {
                                                                            echo "selected";
                                                                        }
                                                                        ?>>Kuala Lumpur</option>
                                                                        <option value="Melaka" <?php
                                                                        if ($result->State == "Melaka") {
                                                                            echo "selected";
                                                                        }
                                                                        ?>>Melaka</option>
                                                                        <option value="Negeri Sembilan" <?php
                                                                                if ($result->State == "Negeri Sembilan") {
                                                                                    echo "selected";
                                                                                }
                                                                                ?>>Negeri Sembilan</option>
                                                                        <option value="Pahang" <?php
                                                            if ($result->State == "Pahang") {
                                                                echo "selected";
                                                            }
                                                            ?>>Pahang</option>
                                                                        <option value="Penang" <?php
                                                            if ($result->State == "Penang") {
                                                                echo "selected";
                                                            }
                                                            ?>>Penang</option>
                                                                        <option value="Perak" <?php
                                                            if ($result->State == "Perak") {
                                                                echo "selected";
                                                            }
                                                            ?>>Perak</option>
                                                                        <option value="Perlis" <?php
                                                            if ($result->State == "Perlis") {
                                                                echo "selected";
                                                            }
                                                            ?>>Perlis</option>
                                                                        <option value="Sabah" <?php
                                                if ($result->State == "Sabah") {
                                                    echo "selected";
                                                }
                                                ?>>Sabah</option>
                                                                        <option value="Sarawak" <?php
                                                if ($result->State == "Sarawak") {
                                                    echo "selected";
                                                }
                                                ?>>Sarawak</option>
                                                                        <option value="Selangor" <?php
                                                if ($result->State == "Selangor") {
                                                    echo "selected";
                                                }
                                                ?>>Selangor</option>
                                                                        <option value="Terengganu" <?php
                                                if ($result->State == "Terengganu") {
                                                    echo "selected";
                                                }
                                                ?>>Terengganu</option>
                                                                    </select>
                                                                </div>
                                                                <label class="col-sm-2 control-label">Gender <span style="color:red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <select name="gender" class="form-control" required>
                                                                        <option value="">---Select---</option>
                                                                        <option value="Male" <?php
                                                if ($result->Gender == "Male") {
                                                    echo "selected";
                                                }
                                                ?>>Male</option>
                                                                        <option value="Female" <?php
                                                if ($result->Gender == "Female") {
                                                    echo "selected";
                                                }
                                                ?>>Female</option>
                                                                    </select>
                                                                </div> 

                                                            </div>


                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label">Address/Zip Code<span style="color:red">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text"  name="address"  value="<?php echo htmlentities($result->Address); ?>" required class="form-control">                                               
                                                                </div>
                                                            </div>
                                                            <div class="hr-dashed"></div>

        <?php
        }
    }
    ?>
                                                    <div class="form-group">
                                                        <div class="col-sm-6 col-sm-offset-4">
                                                            <a class="btn btn-md btn-default" href="donor-list.php" role="button"><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;<b>Back</b></font></a>
                                                            <button type="submit" name="update" value="Update" class="btn-primary btn btn-lg"><font face="Trebuchet MS" style="font-size:14px;"><b>Update</b>&nbsp;<span class="glyphicon glyphicon-ok"></span></font></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
}

                  