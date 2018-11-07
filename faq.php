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

    </head>
    <body>
        <?php include('includes/header.php'); ?>
        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="mt-4 mb-3">FAQ's</h1>

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active">FAQ's</li>
                    </ol>

                    <div>
                        <div class="jumbotron">
                            <ul>
                                <li><a href="#tx">What is organ transplantation?</a></li>
                                <li><a href="#txWhich">Which organs can transplanted?</a></li>
                                <li><a href="#txMatch">What factors are considered in organ matching and allocation?</a></li>
                                <li><a href="#txDist">How are organs distributed?</a></li>
                                <li><a href="#txWait">How do I get on the waiting list?</a></li>
                                <li><a href="#txList">How do I know that I am listed?</a></li>
                                <li><a href="#txLong">How long will I have to wait?</a></li>
                                <li><a href="#txAge"> Are there age limits that rule out organ transplantation?</a></li>
                            </ul>
                        </div> 

                        <h5 style="color:red;">
                            <a id="tx"></a>What is organ transplantation?</h5>
                        <p>If you have a medical condition that may cause one or more of your vital organs to fail, transplantation may be a 
                            treatment option. A transplant is a surgical operation to give a functioning human organ to someone whose organ has 
                            stopped working or is close to failing. In some cases, a living person can donate all or part of a functioning organ. 
                            In other instances, the donor would be someone who has recently passed away. </p>
                        <h5 style="color:red;">
                            <a id="txWhich"></a>Which organs can transplanted?</h5>
                        <p>The organs that can be transplanted are:</p>
                        <ul>
                            <li>Kidney</li>
                            <li>Heart</li>
                            <li>Lungs</li>
                            <li>Liver</li>
                            <li>Pancreas</li>                           
                        </ul>
                        <h5 style="color:red;">
                            <a id="txMatch"></a>What factors are considered in organ matching and allocation?</h5>
                        <p>Many different medical and logistical characteristics are considered for an organ to be distributed to the 
                            best-matched potential recipient.The matching or ranking criteria used in considering potential organ transplant 
                            recipients include:</p>
                        <ul><li>Medical Urgency:  This aspect plays important role in the matching. If someone is in imminent mortal danger 
                                or is listed in urgent status and can only be rescued by an immediate transplant, that person has priority. 
                                It is represented by the “Urgent? Yes/No” in the allocation algorithm.</li>
                            <li>Blood Type Compatibility: whether the donor and patient have compatible blood type or not.</li> 
                            <li> Age: Children aged less than 18 will have priority</li>
                            <li>State Similarity: whether the donor and patient live in the same State in Malaysia</li>
                            <li>Time on the waiting list: how long a patient is waiting for the transplantation of an organ.</li>
                        </ul>

                        <h5 style="color:red;">
                            <a id="txDist"></a>How are organs distributed?</h5>
                        <p>The organs are distributed in the same State first, and if no match is found they are then offered to the other States in Malaysia,
                            and until a recipient is found. Every attempt is made to place donor organs. A patient has the right to refuse the organ  
                            allocated through the OOMS. However, he/she will then be removed from the list. The patient may then apply to be re-listed.</p> 

                        <h5 style="color:red;">
                            <a id="txWait"></a>How do I get on the waiting list?</h5>
                        <p>To get on the OOMS waiting list, you should follow these steps: </p> 
                        <ul>
                            <li>Contact a transplant center.</li>
                            <li>Medical evaluation is done to determine if you are a good candidate for transplant.</li>
                            <li>If the transplant team determines that you are a good transplant candidate, they will add 
                                you to the OOMS waiting list.</li>
                        </ul>
                        <h5 style="color:red;">
                            <a id="txList"></a>How do I know that I am listed?</h5>
                        <p>OOMS does not send patients written confirmation of their placement on the waiting list. Instead, patients should find out 
                            if they have been placed on the national waiting list through their transplant center.</p> 

                        <h5 style="color:red;">
                            <a id="txLong"></a>How long will I have to wait?</h5>
                        <p>Once you are added to the OOMS waiting list, you may receive an organ that day, or you may 
                            wait many years. Factors affecting how long you wait is based on the allocation algorithm.</p> 
                        <h5 style="color:red;">
                            <a id="txAge"></a>Are there age limits that rule out organ transplantation?</h5>
                        <p>There is no standard age limit to be transplanted. Regardless of age, sex, religion or race, any patient can be added to the waiting list.</p> 
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
        <!-- Footer -->
        <?php include('includes/footer.php'); ?>

        <!-- Bootstrap core Java Script -->
        <script src="js/vendor/jquery.min.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>
    </body>
</html>
