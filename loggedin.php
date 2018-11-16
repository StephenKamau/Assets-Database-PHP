<?php
//start the session
require "session.php";
?>
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

    <nav class="site-header sticky-top py-1 bg-dark">
        <div class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2" href="#">ASSETS <i class="br fas fa-database"></i></a>
            <a class="py-2 d-none d-md-inline-block" href="viewusers.php">Users <i class="fas fa-users"></i></a>
            <a class="py-2 d-none d-md-inline-block" href="viewitems.php">Items <i class="fas fa-shopping-basket"></i></a>
            <a class="py-2 d-none d-md-inline-block" href="viewlocations.php">Locations <i class="fas fa-location-arrow"></i></a>
            <a class="py-2 d-none d-md-inline-block" href="viewresponsibility.php">Responsibility <i class="fas fa-cogs"></i></a>
            <a class="py-2 d-none d-md-inline-block l" href="#"><i class="fas fa-user-circle"></i> Logged in as: <?php echo $_SESSION['user'] ?></a>
            <a class="py-2 d-none d-md-inline-block" href="config/logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md bg-l d">
                <h2 class="title">User Details</h2>
                <a class="btn btn-info" href="viewusers.php">Go to Records <i class='fas fa-chevron-right'></i></a>
                <p></p>

                <!--PHP code-->
                <?php
                // get passed parameter value, in this case, the record ID
                // isset() is a PHP function used to verify if a value is there or not
                $id = isset($_SESSION['id']) ? $_SESSION['id'] : die('ERROR: Record ID not found.');
 
                //include database connection
                include 'config/database.php';
 
                // read current record's data
                try {
                    // prepare select query
                    $query = "SELECT id,firstname,lastname,emailaddress,idnumber,dateofbirth,gender,phone FROM user WHERE id = ? LIMIT 0,1";
                    $stmt = $con->prepare($query);
     
                    // this is the first question mark
                    $stmt->bindParam(1, $id);
     
                    // execute our query
                    $stmt->execute();
     
                    // store retrieved row to a variable
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
                    // values to fill up our form
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $emailaddress = $row['emailaddress'];
                    $idnumber = $row['idnumber'];
                    $dateofbirth = $row['dateofbirth'];
                    $gender = $row['gender'];
                    $phone = $row['phone'];
                } catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
                ?>

                <!--PHP update-->
                <?php
                //check if form was submitted
                if ($_POST) {
                    try {
                        //update query
                        $query = "UPDATE user SET firstname=:firstname,lastname=:lastname,emailaddress=:emailaddress,idnumber=:idnumber,dateofbirth=:dateofbirth,gender=:gender,phone=:phone,password=:password WHERE id=:id";

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

                            //hash the password
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            //bind the parameters
                            $stmt->bindParam(':id', $id);
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
                                echo "<div class='alert alert-success'>Password Updated.</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Unable to update record.</div>";
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

                <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id={$id}"; ?>" method="POST">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="firstname">First Name:</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo htmlspecialchars($firstname, ENT_QUOTES); ?>" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="lastname">Last Name:</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo htmlspecialchars($lastname, ENT_QUOTES); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emailaddress">Email Address:</label>
                        <input type="email" class="form-control" name="emailaddress" placeholder="user@mail.com" value="<?php echo htmlspecialchars($emailaddress, ENT_QUOTES); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="idnumber">ID Number:</label>
                        <input type="text" class="form-control" name="idnumber" placeholder="123456789" value="<?php echo htmlspecialchars($idnumber, ENT_QUOTES); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="dateofbirth">Date of Birth:</label>
                        <input type="date" class="form-control" name="dateofbirth" value="<?php echo htmlspecialchars($dateofbirth, ENT_QUOTES); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="Female" <?= $gender == 'Female' ? ' selected="selected"' : ''; ?>>Female</option>
                            <option value="Male" <?= $gender == 'Male' ? ' selected="selected"' : ''; ?>>Male</option>
                            <option value="Other" <?= $gender == 'Other' ? ' selected="selected"' : ''; ?>>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone" placeholder="+2547123456678" value="<?php echo htmlspecialchars($phone, ENT_QUOTES); ?>" required>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-dark" data-toggle="collapse" href="#change" role="button" aria-expanded="false" aria-controls="collapseExample">Change Password <i class='fas fa-chevron-down'></i></a>
                    </div>
                    <div class="collapse" id="change">
                        <div class="form-group">
                            <label for="password">New Password:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword">Confirm Password:</label>
                            <input type="password" class="form-control" name="confirmpassword" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="Save Changes" value="Save Changes" class="btn btn-success">
                        </div>
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