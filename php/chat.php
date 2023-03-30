<?php
include_once "config.php";
session_start();
if (isset($_SESSION['unique_id'])) {
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $insert = "INSERT INTO messages(outgoing_id,incoming_id,message) VALUES('$outgoing_id','$incoming_id','$message')";
    if (!empty($message)) {
        $result = mysqli_query($conn, $insert) or die();
    }
} else {
    header("../login.php");
}
