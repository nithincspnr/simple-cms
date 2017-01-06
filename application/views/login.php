<?php include_once('shared/top_header.php'); ?>

    <div class="login-outer">
        <div class="login-container">
            <form action="<?php echo $action ?>" method="<?php echo $method ?>">
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

<!-- footer -->
</body>
</html>