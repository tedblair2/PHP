<?php
include_once "config.php";
session_start();
if (isset($_SESSION['unique_id'])) {
    $status = "Offline now";
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    if (isset($id)) {
        $sql = "UPDATE users SET status='$status' WHERE unique_id='$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            session_unset();
            session_destroy();
            header("Location:../login.php");
        }
    } else {
        header("Location:../users.php");
    }
} else {
    header("Location:../login.php");
}
