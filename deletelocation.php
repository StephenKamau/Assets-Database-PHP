<?php
//include the database connection
include "config/database.php";
require "session.php";
try {
    //get record id
    $id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID not found');

    //delete query
    $query = "DELETE FROM locations WHERE id=?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);

    if ($stmt->execute()) {
        // redirect to read records page and 
        // tell the user record was deleted
        header('Location: viewlocations.php?action=deleted');
    } else {
        die('Unable to delete record.');
    }
} catch (PDOException $exception) {
    die('Error:' . $exception->getMessage());
}