<?php
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

        <title>Online Organ Matching System</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/modern-business.css" rel="stylesheet">
        <!--Picture Slider-->
        <style> 
            .navbar-toggler {
                z-index: 1;
            }

            @media (max-width: 576px) {
                nav > .container {
                    width: 100%;
                }
            }
            .carousel-item.active, 
            .carousel-item-next,
            .carousel-item-prev {
                display: block;
            }
        </style>

    </head>
    <body>
        <!-- Navigation -->
        <?php include('includes/header.php'); ?>
        <?php include('includes/slider.php'); ?>
        <br>
        <!-- Page Content -->
        <div class="container">

            <h1 class="mb-4">Welcome to Online Organ Matching System</h1>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <h4 class="card-header" style="color:red;">Why organ donation is important?</h4>
                        <p class="card-text" style="padding-left:2%">There are many people on the organ transplant waiting list. Unfortunately, there are fewer organ donors available than there are people waiting. Transplants can save or transform the life of a person. One organ donor can help transform the lives of more than 10 people.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <h4 class="card-header" style="color:red;">Organ Donation Facts</h4>
                        <ul class="card-text" style="padding-left:6%">
                            <li>You can be a donor at any age.</li>
                            <li>A healthy person can become a living donor by donating organs.</li>
                            <li>Living donation increases the existing organ supply.</li>
                            <li>Donation is possible with many medical conditions.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <h4 class="card-header" style="color:red;">Who you could help?</h4>
                        <p class="card-text" style="padding-left:2%">Some people die waiting for a transplant. Some spend weeks or months in hospital, while others make several trips to hospital every week for treatment. 
                            People who need an organ transplant are usually very sick or dying, because one or more of their organs is failing. They range from children through to older people. </p>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="row">
                <div class="col-lg-6">
                    <h2>ORGANS DONATED</h2>
                    <p>  The organs that are donated by organ donors are the following:</p>
                    <ul> 
                        <li>Kidney</li>
                        <li>Heart</li>
                        <li>Liver</li>
                        <li>Lungs</li>
                        <li>Pancreas</li>
                    </ul>
                    <h4 style="color:red;">How organ matching works</h4>
                    <p> After medical evaluation, a transplant center adds the recipient's medical information into OOMS waiting list. When a deceased organ donor is identified, the OOMS generates a ranked list of transplant candidates, or “matches”, based on the <b>Allocation Algorithm</b> (medical urgency, age, geography, blood type and waiting time)</p>
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid rounded" src="images/donor-hero.png" alt="">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-8">
                    <h4 style="color:red;">Donor Types</h4>
                    <p> If the donor prefers to be a deceased donor (donate after death), the donor needs to register online and if the donors wants to be a living donor (donate while alive), the donor can contact the transplant centre through OOMS.</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-secondary btn-block btn-success" href="become-donor.php">Be a Deceased Donor</a>
                    <a class="btn btn-lg btn-secondary btn-block btn-success" href="contact.php">Be a Living Donor</a>
                </div>
            </div>
        </div>
        <!-- /.container -->

        <!-- Footer -->
        <?php include('includes/footer.php'); ?>

        <!-- Bootstrap core Java Script -->
        <script src="js/vendor/jquery.min.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>

    </body>
</html>
