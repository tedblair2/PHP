<?php
include_once "config.php";
session_start();
$unique_id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
$output = "";
$sql = "SELECT * FROM users WHERE NOT unique_id={$unique_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($user = mysqli_fetch_assoc($result)) {
        $output .= '<a href="chats.php?user_id=' . $user['unique_id'] . '">
                        <div class="content">
                            <img src="./php/profiles/' . $user['img'] . '" alt="profile" width="40px" height="40px">
                            <div class="details">
                                <span>' . $user['fname'] . ' ' . $user['lname'] . '</span>
                                <p>This is test message</p>
                            </div>
                        </div>
                        <div class="status-dot"><i class="fa fa-circle" aria-hidden="true"></i></div>
                    </a>';
    }
} else {
    $output .= "No such user exists";
}
echo $output;
