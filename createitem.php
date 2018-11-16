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
                <h2 class="title">Add Item</h2>
                <a class="btn btn-danger" href="viewitems.php"><i class="fas fa-chevron-left"></i> Back to Records</a>
                <p></p>

                <!--PHP code-->
                <?php

                if ($_POST) {
                    //include the connection file
                    include "config/database.php";

                    try {

                        //query for inserting the records
                        $query = "INSERT INTO items SET name=:name,value=:value,description=:description,expirydate=:expirydate";

                        //prepare the query
                        $stmt = $con->prepare($query);

                        //posted values
                        $name = htmlspecialchars(strip_tags($_POST['name']));
                        $value = htmlspecialchars(strip_tags($_POST['value']));
                        $description = htmlspecialchars(strip_tags($_POST['description']));
                        $expirydate = htmlspecialchars(strip_tags($_POST['expirydate']));

                        //bind the parameters
                        $stmt->bindParam(':name', $name);
                        $stmt->bindParam(':value', $value);
                        $stmt->bindParam(':description', $description);
                        $stmt->bindParam(':expirydate', $expirydate);

                        //execute the query
                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success'>Record saved.</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Unable to save record.</div>";
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
                                <label for="name">Item Name:</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="value">Value:</label>
                                <input type="number" class="form-control" name="value" id="value" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <input type="text" class="form-control" name="description" id="description" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="expirydate">Expiry Date:</label>
                                <input type="date" class="form-control" name="expirydate" id="expirydate" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="Submit" value="Submit" class="btn btn-success">
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