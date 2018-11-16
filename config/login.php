<?php
//include the connection 
include "database.php";

//start the session
session_start();

//check if data is posted
if ($_POST) {
    try {
        //query for getting the records
        $query = "SELECT id,firstname,lastname,emailaddress,idnumber,dateofbirth,gender,phone FROM user WHERE emailaddress=:emailaddress";

        $emailaddress = htmlspecialchars(strip_tags($_POST['emailaddress']));
        $password = htmlspecialchars(strip_tags($_POST['password']));

        //bind the parameters
        $stmt->bindParam(':emailaddress', $emailaddress);
        $stmt->bindParam(':password', $password);

        $stmt = $con->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //check if there is any user
        if ($count == 1) {
            $hash = $row['password'];
            //verify the password
            if (password_verify($password, $hash)) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['user'] = $row['firstname'] . " " . $row['lastname'];
                header("Location:viewusers.php");
            } else {
                echo "<div class='alert alert-danger'>Invalid password.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Invalid username.</div>";
        }

    } catch (PDOException $exception) {
        die('Error:' . $exception->getMessage());
    }
}