<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns"
        crossorigin="anonymous">
    <title>Assets</title>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 bg-l d">
                <h1 class="text-center">ASSETS <i class="br fas fa-database"></i></h1>
                <h2 class="title c">Sign Up</h2>
                <p></p>

                <!--PHP code-->
                <?php

                if ($_POST) {
                    //include the connection file
                    include "config/database.php";

                    try {

                        //query for inserting the records
                        $query = "INSERT INTO user SET firstname=:firstname,lastname=:lastname,emailaddress=:emailaddress,idnumber=:idnumber,dateofbirth=:dateofbirth,gender=:gender,phone=:phone,password=:password";

                        //prepare the query
                        $stmt = $con->prepare($query);

                        //posted values
                        $firstname = htmlspecialchars(strip_tags($_POST['firstname']));
                        $lastname = htmlspecialchars(strip_tags($_POST['lastname']));
                        $emailaddress = htmlspecialchars(strip_tags($_POST['emailaddress']));
                        $idnumber = htmlspecialchars(strip_tags($_POST['idnumber']));
                        $dateofbirth = htmlspecialchars(strip_tags($_POST['dateofbirth']));
                        $gender = htmlspecialchars(strip_tags($_POST['gender']));
                        $phone = htmlspecialchars(strip_tags($_POST['phone']));

                        //checks if passwords match
                        $password = htmlspecialchars(strip_tags($_POST['password']));
                        $confirmpassword = htmlspecialchars(strip_tags($_POST['confirmpassword']));
                        if ($password == $confirmpassword) {
                            $password = password_hash($password, PASSWORD_DEFAULT);

                        //bind the parameters
                            $stmt->bindParam(':firstname', $firstname);
                            $stmt->bindParam(':lastname', $lastname);
                            $stmt->bindParam(':emailaddress', $emailaddress);
                            $stmt->bindParam(':idnumber', $idnumber);
                            $stmt->bindParam(':dateofbirth', $dateofbirth);
                            $stmt->bindParam(':gender', $gender);
                            $stmt->bindParam(':phone', $phone);
                            $stmt->bindParam(':password', $password);

                        //execute the query
                            if ($stmt->execute()) {
                                echo "<div class='alert alert-success'>Account Created. <a href='login.php' class='btn btn-success'>Head to Login <i class='fas fa-chevron-right'></i></a></div>";
                            } else {
                                echo "<div class='alert alert-danger'>Unable to create account.</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Passwords don't match.</div>";
                        }
                    } catch (PDOException $exception) {
                        die('Error:' . $exception->getMessage());
                    }
                }
                ?>

                <!--User form-->

                <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="firstname">First Name:</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="lastname">Last Name:</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emailaddress">Email Address:</label>
                        <input type="email" class="form-control" name="emailaddress" placeholder="user@mail.com"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="idnumber">ID Number:</label>
                        <input type="text" class="form-control" name="idnumber" placeholder="123456789" required>
                    </div>
                    <div class="form-group">
                        <label for="dateofbirth">Date of Birth:</label>
                        <input type="date" class="form-control" name="dateofbirth" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone" placeholder="+2547123456678" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirm Password:</label>
                        <input type="password" class="form-control" name="confirmpassword" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="Sign Up" value="Sign Up" class="btn btn-success">
                    </div>

                    <div class="form-group text-center">
                        <a class="d-none d-md-inline-block" href="login.php">Have an account? Sign in here</a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>