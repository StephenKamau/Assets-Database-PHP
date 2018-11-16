<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Assets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns"
        crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-6 bg-l d">
                <h1 class="text-center">ASSETS <i class="br fas fa-database"></i></h1>
                <p></p>
                <div class="icon"><i class="fas fa-user-circle icon"></i></div>
                <h2 class="title c">Login</h2>
                <p></p>
                <?php
                //include the connection 
                include "config/database.php";
                
                //start the session
                session_start();
                
                //check if data is posted
                if ($_POST) {
                    try {
                        //query for getting the records
                        $query = "SELECT * FROM user WHERE emailaddress=:emailaddress";

                        $email = htmlspecialchars(strip_tags($_POST['email']));
                        $pwd = htmlspecialchars(strip_tags($_POST['pwd']));

                        $stmt = $con->prepare($query);
                
                        //bind the parameter
                        $stmt->bindParam(':emailaddress', $email);

                        //execute
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $count = $stmt->rowCount();
                
                        //check if there is any user
                        if ($count == 1) {
                            $hash = $row['password'];
                            //verify the password
                            if (password_verify($pwd, $hash)) {
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
                ?>
                <!--Login form-->
                <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group">
                        <label for="emailaddress">Email Address:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="pwd" id="pwd" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="Login" id="Login" value="Login" class="btn btn-primary" required>
                    </div>
                    <div class="form-group text-center">
                        <a class="d-none d-md-inline-block" href="signup.php">No account? Signup here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>