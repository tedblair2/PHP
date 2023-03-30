<?php
//superglobals $_GET['name'] and $_POST['name'] and others below

echo $_SERVER['SERVER_NAME'] . '<br />';
echo $_SERVER['PHP_SELF'] . '<br />';
echo $_SERVER['REQUEST_METHOD'] . '<br />';

session_start(); //is necessary everytime you want to access a SESSION
$_SESSION['name'] = 'Ted'; //saves a sesion called name with value Ted that is availale throughout the website


if ($_SERVER['QUERY_STRING'] == '') {
    unset($_SESSION['name']); //removing the session
}
echo $_SESSION['name'] ?? "Guest" . '<br />'; //checking for null values using ??

//setting cookies
setcookie('gender', 'Male', time() + 6000); //seting a cookie stored on user's device
//accessing the cookie
echo $_COOKIE['gender'] ?? 'Unknown'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>