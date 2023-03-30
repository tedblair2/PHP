<?php
include_once "config.php";
session_start();
$output = '';
if (isset($_SESSION['unique_id'])) {
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);

    $sql = "SELECT * FROM messages WHERE (outgoing_id='$outgoing_id' AND incoming_id='$incoming_id') OR (outgoing_id='$incoming_id' AND incoming_id='$outgoing_id') ORDER BY msg_id ASC";
    $sql2 = "SELECT * FROM users WHERE unique_id='$incoming_id'";
    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result) > 0) {
        $chats = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $user = mysqli_fetch_assoc($result2);
        foreach ($chats as $chat) {
            if ($chat['outgoing_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $chat['message'] . '</p>
                                </div>
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="./php/profiles/' . $user['img'] . '" alt="profile">
                                <div class="details">
                                    <p>' . $chat['message'] . '</p>
                                </div>
                            </div>';
            }
        }
        echo $output;
    }
} else {
    header("Location:users.php");
}
