<?php
session_start();
include_once "config.php";

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $unique_id = $row['unique_id'];
            $sql2 = "UPDATE users SET status='Active now' WHERE unique_id='$unique_id'";
            $result2 = mysqli_query($conn, $sql2);
            $_SESSION['unique_id'] = $unique_id;
            echo "success";
        } else {
            echo "Email or password doesn't match";
        }
    } else {
        echo "$email is not a valid email";
    }
} else {
    echo "All input fields have to be field";
}
