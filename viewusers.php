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
            <a class="py-2 d-none d-md-inline-block l" href="loggedin.php"><i class="fas fa-user-circle"></i> Logged in as: <?php echo $_SESSION['user'] ?></a>
            <a class="py-2 d-none d-md-inline-block" href="config/logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md bg-l d">
                <h2 class="title">Users</h2>
                <nav class="nav">
                    <li class="nav-item">
                        <a class="btn btn-primary mr-sm-2" href="createuser.php"><i class="fas fa-plus-circle"></i> Add User</a>
                    </li>
                    <form class="form-inline my-2 my-lg-0" action="searchuser.php" method="POST">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" required>
                        <input type="submit" name="Search" value="Search" class="btn btn-success">
                    </form>
                </nav>
                <p></p>
                <?php
                $action = isset($_GET['action']) ? $_GET['action'] : "";
 
                // if it was redirected from delete.php
                if ($action == 'deleted') {
                    echo "<div class='alert alert-success'>Record deleted.</div>";
                }
                ?>
                <table class="table table-bordered table-hover table-sm">
                    <thead class="table-dark">
                        <th>#ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>ID Number</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <?php
                    //include the database connection
                    include "config/database.php";

                    //query for getting the records
                    $query = "SELECT id,firstname,lastname,emailaddress,idnumber,dateofbirth,gender,phone FROM user ORDER BY id ASC";
                    $stmt = $con->prepare($query);
                    $stmt->execute();

                    //count the number of rows
                    $num = $stmt->rowCount();

                    //check more than one record
                    if ($num > 0) {

                        //fetch all the data
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                            //output to the table
                            echo "<tbody class='table-sm'>";
                            echo "<tr>";
                            echo "<td>{$id}</td>";
                            echo "<td>{$firstname}</td>";
                            echo "<td>{$lastname}</td>";
                            echo "<td>{$emailaddress}</td>";
                            echo "<td>{$idnumber}</td>";
                            echo "<td>{$dateofbirth}</td>";
                            echo "<td>{$gender}</td>";
                            echo "<td>{$phone}</td>";
                            echo "<td class='text-center'>";
                            echo "<a href='updateuser.php?id={$id}' class='btn btn-primary btn-sm m-r-1em'>Edit</a>";
                            echo " ";
                            echo "<a href='#' onclick='delete_user({$id});' class='btn btn-danger btn-sm m-r-1em'>Delete</a>";
                            echo "</td>";
                            echo "<tr>";
                            echo "</tbody>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>No records found.</div>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <script type='text/javascript'>
    // confirm record deletion
    function delete_user( id ){
        
        var answer = confirm('Are you sure?');
        if (answer){
            // if user clicked ok, 
            // pass the id to delete.php and execute the delete query
            window.location = 'deleteuser.php?id=' + id;
        } 
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>