<?php
include_once "header.php";
include_once "php/config.php";
session_start();
$current_user = '';
$other_user_id = '';
if (!isset($_SESSION['unique_id'])) {
    header("Location:login.php");
} else {
    $current_user = $_SESSION['unique_id'];
    if (isset($_GET['id'])) {
        $other_user_id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM users WHERE unique_id='$other_user_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
        }
    }
}
?>

<body>
    <div class="container">
        <section class="chat-area">
            <header>
                <a href="users.php" class="back-icon"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                <img src="./php/profiles/<?php echo htmlspecialchars($user['img']); ?>" alt="profile">
                <div class="details">
                    <span><?php echo htmlspecialchars($user['fname'] . ' ' . $user['lname']);  ?></span>
                    <p><?php echo htmlspecialchars($user['status'])  ?></p>
                </div>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="outgoing_id" id="" value="<?php echo $current_user; ?>" hidden>
                <input type="text" name="incoming_id" id="" value="<?php echo $other_user_id; ?>" hidden>
                <input type="text" name="message" id="" class="input_msg" placeholder="Type Message Here....">
                <button><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </form>
        </section>
    </div>
    <script src="./js/chats.js"></script>

</body>

</html>