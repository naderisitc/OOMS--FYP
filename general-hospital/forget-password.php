<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['submit'])) {

    $email = $_POST['email'];

    $sql = "SELECT UserName, HospitalName FROM tablegeneralhospital WHERE Email=:email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $username = $result->UserName;
            $hospital = $result->HospitalName;
            require 'phpmailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;

//$mail->SMTPDebug = 4;                               // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->Host = 'smtp.aol.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'nadrex2009@aol.com';                 // SMTP username
            $mail->Password = 'NkmS2013';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('nadrex2009@aol.com', 'Online Organ Matching System');
            $mail->addAddress($email, 'General Hospital');     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('nadrex2009@aol.com');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            $mail->addAttachment('images/hospital.jpg');         // Add attachments
            //$mail->addAttachment('/images/ts-avatar.png', 'Pic');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $generatedPassword1 = (rand(999, 999999)); //reset password
            $generatedPassword = $generatedPassword1;

            $mail->Subject = 'Reset Password - General Hospital Officer';
            $mail->Body = "Dear $hospital Officer,<br><br>Recently a request was submitted to reset the password for your account."
                    . "  <br> Your new password is $generatedPassword1<br><br> Please log in to your account using the following credentials"
                    . " and change this given password in the OOMS by clicking Account and then Change password to protect your account.<br>"
                    . "Username: $username  <br>Password: $generatedPassword1 <br><br> Regards,<br>OOMS";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if (!$mail->send()) {
                echo 'Message could not be sent.';
                // echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo "<script>alert('Please check your email. We have sent a password reset to your registered email.');</script>";
            }
            $sql1 = "UPDATE tablegeneralhospital SET PassWord=:generatedPassword WHERE Email=:email";
            $query1 = $dbh->prepare($sql1);
            $email = $_POST['email'];
            $query1->bindParam(':email', $email, PDO::PARAM_STR);
            $query1->bindParam(':generatedPassword', $generatedPassword, PDO::PARAM_STR);
            $query1->execute();
        }
    } else {
        echo "<script>alert('Email not registered in our database. Please use other email.');</script>";
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

        <title>Forget Password | Hospital Log In</title>
        <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Main Bootstrap -->
        <link rel="stylesheet" href="css/style.css"> <!-- Header Stye -->

    </head>

    <body>
        <div class="login-page bk-img" style="background-image: url(images/hospital.jpg);">
            <div class="form-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <h1 class="text-center text-bold mt-2x" style="color:red;">Forget Password/Username</h1>
                            <div class="well row pb-2x pb-2x ">
                                <div class="col-md-8 col-md-offset-2">
                                    <img src="images/ts-avatar.jpg" class="img-circle center-block"  alt="" style="width: 50%"><br>
                                    <form method="post" style="margin-top: 25px;">
                                        <p>Enter your email address to reset your password</p>
                                        <div class="form-group">
                                            <div  class="fa fa-envelope text-primary text-bold"><font face="Trebuchet MS" style="font-size:14px;"><b> Email Address</b></font></div>
                                            <input type="email" placeholder="Enter your Email Address" name="email" class="form-control mb" required>
                                        </div>

                                        <a href="hindex.php" class="btn btn-danger"><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Back</b></font></a>
                                        <button class="btn btn-default btn-lg" name="submit" type="submit"><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-refresh"></span>&nbsp;<b>Reset</b></font></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>     
        <!-- Bootstrap core Java Script -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>


