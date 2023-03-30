<?php include_once "header.php" ?>

<body>
    <div class="container">
        <section class="form login">
            <header>Realtime ChatApp</header>
            <form action="#" autocomplete="off">
                <div class="error-txt">Error message here</div>
                <div class="field input">
                    <label>Email</label>
                    <input type="email" name="email" id="" placeholder="Enter your Email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" id="" placeholder="Enter your Password" required>
                    <i class="fa fa-eye" aria-hidden="true" onclick="changePassword()"></i>
                </div>
                <div class="field btn">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Don't have an account? <a href="index.php">Sign Up now</a></div>
        </section>
    </div>
    <script src="./js/pswd.js"></script>
    <script src="./js/login.js"></script>
</body>

</html>