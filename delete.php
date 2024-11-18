<?php
include "db.php";

$id = $_POST['id'];

$sql = "DELETE FROM produtos WHERE id='$id'";
if ($connection->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}

$connection->close();
?>
