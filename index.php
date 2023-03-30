<?php
include_once "header.php";
session_start();
if (isset($_SESSION['unique_id'])) {
    header("Location:users.php");
}
?>

<body>
    <div class="container">
        <section class="form sign-up">
            <header>Realtime ChatApp</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname" id="" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname" id="" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Email</label>
                    <input type="email" name="email" id="" placeholder="Enter your Email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" id="" placeholder="Enter your Password" required>
                    <i class="fa fa-eye" aria-hidden="true" onclick="changePassword()"></i>
                </div>
                <div class="field">
                    <label>Select Image</label>
                    <input type="file" name="image" id="" required>
                </div>
                <div class="field btn">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Already signed up? <a href="login.php">Login now</a></div>
        </section>
    </div>
    <script src="./js/pswd.js"></script>
    <script src="./js/signup.js"></script>

</body>

</html>