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
                <h2 class="title">Search Results</h2>
                <a class="btn btn-danger mr-sm-2" href="viewitems.php"><i class="fas fa-chevron-left"></i> Back to Records</a>
                <p></p>
                <?php
                $id = isset($_POST['search']) ? $_POST['search'] : "";

                echo "<div class='alert alert-success'>Showing results for item: " . $id . "</div>";

                ?>
                <table class="table table-bordered table-hover table-sm">
                    <thead class="table-dark">
                        <th>#ID</th>
                        <th>Item Name</th>
                        <th>Value</th>
                        <th>Description</th>
                        <th>Expiry Date</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <?php
                    //include the database connection
                    include "config/database.php";

                    if (isset($_POST['search'])) {

                        $id = $_POST['search'];

                        //query for getting the records
                        $query = "SELECT id,name,value,description,expirydate FROM items WHERE id=:id";
                        $stmt = $con->prepare($query);

                        //bind the parameter
                        $stmt->bindParam(':id', $id);

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
                                echo "<td>{$name}</td>";
                                $value = $row['value'];
                                $value = number_format($value, 2);
                                echo "<td class='text-right'>$value</td>";
                                echo "<td>{$description}</td>";
                                echo "<td>{$expirydate}</td>";
                                echo "<td class='text-center'>";
                                echo "<a href='updateitem.php?id={$id}' class='btn btn-primary btn-sm m-r-1em'>Edit</a>";
                                echo " ";
                                echo "<a href='#' onclick='delete_item({$id});' class='btn btn-danger btn-sm m-r-1em'>Delete</a>";
                                echo "</td>";
                                echo "<tr>";
                                echo "</tbody>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>No records found.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Request id could not be found.</div>";
                    }

                    ?>
                </table>
            </div>
        </div>
    </div>

    <script type='text/javascript'>
    // confirm record deletion
    function delete_item( id ){
        
        var answer = confirm('Are you sure?');
        if (answer){
            // if user clicked ok, 
            // pass the id to delete.php and execute the delete query
            window.location = 'deleteitem.php?id=' + id;
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