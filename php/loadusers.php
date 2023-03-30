<?php
include_once "config.php";
session_start();
$unique_id = $_SESSION['unique_id'];
$output = "";
$all = "SELECT * FROM users";
$result2 = mysqli_query($conn, $all);
$users = mysqli_fetch_all($result2, MYSQLI_ASSOC);
if (mysqli_num_rows($result2) == 1) {
    $output .= "No user to chat with";
} else {
    foreach ($users as $user) {
        if ($user['unique_id'] != $unique_id) {
            $sql = "SELECT * FROM messages WHERE (incoming_id={$user['unique_id']} OR outgoing_id={$user['unique_id']}) AND (outgoing_id=$unique_id OR incoming_id=$unique_id) ORDER BY msg_id DESC LIMIT 1";
            $result3 = mysqli_query($conn, $sql);
            $msg = mysqli_fetch_assoc($result3);
            if (mysqli_num_rows($result3) > 0) {
                $last_msg = $msg['message'];
            } else {
                $last_msg = 'No message available';
            }
            $you = "";
            (strlen($last_msg) > 26) ? $to_show = substr($last_msg, 0, 26) . '...' : $to_show = $last_msg;
            ($user['status'] === "Offline now") ? $offline = "offline" : $offline = "";
            // ($unique_id === $msg['outgoing_id']) ? $you = "You: " : $you = "";
            $output .= '<a href="chats.php?id=' . $user['unique_id'] . '">
                        <div class="content">
                            <img src="./php/profiles/' . $user['img'] . '" alt="profile" width="40px" height="40px">
                            <div class="details">
                                <span>' . $user['fname'] . ' ' . $user['lname'] . '</span>
                                <p>' . $to_show . '</p>
                            </div>
                        </div>
                        <div class="status-dot ' . $offline . '"><i class="fa fa-circle" aria-hidden="true"></i></div>
                    </a>';
        }
    }
}
echo $output;
