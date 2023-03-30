<?php
include_once "header.php";
include_once "php/config.php";
session_start();
$unique_id = '';
if (!isset($_SESSION['unique_id'])) {
    header("Location:login.php");
} else {
    $unique_id = $_SESSION['unique_id'];
    $sql = "SELECT * FROM users WHERE unique_id = '$unique_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)) {
        $current_user = mysqli_fetch_assoc($result);
    }
    $all = "SELECT * FROM users";
    $result2 = mysqli_query($conn, $all);
    $users = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    if (mysqli_num_rows($result2) == 1) {
        echo "No user to chat with";
    }
}
?>

<body>
    <div class="container">
        <section class="users">
            <header>
                <div class="content">
                    <img src="./php/profiles/<?php echo htmlspecialchars($current_user['img']) ?>" alt="profile">
                    <div class="details">
                        <span><?php echo htmlspecialchars($current_user['fname'] . ' ' . $current_user['lname'])  ?></span>
                        <p><?php echo htmlspecialchars($current_user['status'])  ?> </p>
                    </div>
                </div>
                <a href="php/logout.php?id=<?php echo htmlspecialchars($unique_id);  ?>" class="logout">Log Out</a>
            </header>
            <div class="search">
                <span class="text">Select a user to start chat</span>
                <input type="search" name="search" id="" placeholder="Search User...">
                <button><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
            <div class="users-list">

            </div>

        </section>
    </div>
    <script src="./js/users.js"></script>

</body>

</html>