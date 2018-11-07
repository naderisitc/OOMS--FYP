<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['send'])) {
    //Get inputs
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $message = $_POST['message'];
    $sql = "INSERT INTO  tablecontactusquery(FullName,Email,ContactNumber,Message) VALUES(:name,:email,:contactno,:message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) { // if Query sent
        $msg = " Query Sent. We will contact you shortly.";
    } else {
        $error = " Something went wrong. Please try again."; // if Query not sent
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>OOMS | Contact</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/modern-business.css" rel="stylesheet">

        <!-- Temporary navbar container fix -->
       
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            }
            .succWrap{
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            }
        </style>
    </head>
    <body>
        <?php include('includes/header.php'); ?> <!-- Header-->

        <!-- Page Content -->
        <div class="container">

            <!-- Page Heading/Breadcrumbs -->
            <h1 class="mt-4 mb-3">Contact</h1>

            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>

            <!-- Content Row -->
            <div class="row">

                <div class="col-lg-8 mb-4">
                    <h3>Send us a Message</h3>
                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) {
                        ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                    <form name="sentMessage"  method="post">
                        <div class="form-group">
                            <label>Full Name:</label>
                            <input type="text" pattern="[a-zA-Z\s]+" maxLength="35" title="Enter letters only" class="form-control" id="name" name="fullname" required data-validation-required-message="Please enter your name.">  
                        </div>
                        <div class="form-group">
                            <label>Mobile Number:</label>
                            <input type="text" pattern="[0-9]{14}" maxlength="14" class="form-control" placeholder="Enter only 14 digit numbers" title="Remove any characters/spaces/negative numbers. Enter numbers only, e.g. 00601113328804" id="phone" name="contactno"  required data-validation-required-message="Please enter your phone number.">
                        </div>
                        <div class="form-group">
                            <label>Email Address:</label>
                            <input type="email" class="form-control" id="email" maxLength="35" placeholder="Enter your valid email" name="email" required data-validation-required-message="Please enter your email address.">
                        </div>
                        <div class="form-group">
                            <label>Message:</label>
                            <textarea rows="5" cols="100" class="form-control" id="message" placeholder="Write your message here" name="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                        </div>

                        <button class="btn btn-primary btn-lg text-yellow" name="send" type="submit" ><font face="Trebuchet MS" style="font-size:14px;"><b>Send Message</b></font></button> 
                    </form>
                </div>

                <!-- Transplant Contact Address-->
                <?php
                $pagetype = $_GET['type'];
                $sql = "SELECT Address,Email,ContactNo from tablecontactusinfo";
                $query = $dbh->prepare($sql);
                $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        ?>
                        <div class="col-lg-4 mb-4">
                            <h3>Contact Details</h3>
                            <p><abbr title="Address">Address</abbr>: <?php echo htmlentities($result->Address); ?><br></p>
                            <p><abbr title="Phone">Phone</abbr>: <?php echo htmlentities($result->ContactNo); ?></p>
                            <p><abbr title="Email">Email</abbr>: <a href="mailto:name@example.com"><?php echo htmlentities($result->Email); ?> </a> </p>
                        <?php }
                    }
                    ?>
                </div>
            </div>
        </div>

<?php include('includes/footer.php'); ?>  <!-- Footer -->

        <!-- Bootstrap core Java Script -->
        <script src="js/vendor/jquery.min.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>

    </body>
</html>
