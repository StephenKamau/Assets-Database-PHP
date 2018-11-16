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
                <h2 class="title">Edit Location</h2>
                <a class="btn btn-danger" href="viewlocations.php"><i class='fas fa-chevron-left'></i> Back to Records</a>
                <p></p>

                <!--PHP code-->
                <?php
                // get passed parameter value, in this case, the record ID
                // isset() is a PHP function used to verify if a value is there or not
                $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
                //include database connection
                include 'config/database.php';
 
                // read current record's data
                try {
                    // prepare select query
                    $query = "SELECT id,name,description FROM locations WHERE id = ? LIMIT 0,1";
                    $stmt = $con->prepare($query);
     
                    // this is the first question mark
                    $stmt->bindParam(1, $id);
     
                    // execute our query
                    $stmt->execute();
     
                    // store retrieved row to a variable
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
                    // values to fill up our form
                    $name = $row['name'];
                    $description = $row['description'];
        
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
                        $query = "UPDATE locations SET name=:name,description=:description WHERE id=:id";

                        //prepare the query
                        $stmt = $con->prepare($query);

                        //posted values
                        $name = htmlspecialchars(strip_tags($_POST['name']));
                        $description = htmlspecialchars(strip_tags($_POST['description']));
                        
                        //bind the parameters
                        $stmt->bindParam(':id', $id);
                        $stmt->bindParam(':name', $name);
                        $stmt->bindParam(':description', $description);
        
                        //execute the query
                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success'>Record Updated.</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Unable to update record.</div>";
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
                                <label for="name">Location Name:</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <input type="text" class="form-control" name="description" id="description" value="<?php echo htmlspecialchars($description, ENT_QUOTES); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="Save Changes" value="Save Changes" class="btn btn-success">
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