<?php

include('includes/config.php');
// Code for checking username availabilty for add-hospital-account.php
if (!empty($_POST["username"])) {
    $uname = $_POST["username"];
    $sql = "SELECT UserName FROM  tablegeneralhospital WHERE UserName=:uname";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        echo "<span style='color:red'> Username already exists.Use another one.</span>";
    } else {
        echo "<span style='color:green'> Username available for registration.</span>";
    }
}

// Code for checking email availabilty for add-hospital-account.php
if (!empty($_POST["email"])) {
    $email = $_POST["email"];
    $sql = "SELECT Email FROM  tablegeneralhospital WHERE Email=:email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        echo "<span style='color:red'> Email already exists. Use another one.</span>";
    } else {
        echo "<span style='color:green'> Email available for registration.</span>";
    }
}
?>