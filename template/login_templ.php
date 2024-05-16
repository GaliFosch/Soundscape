<main>
    <img id="front-logo" src="images/logo.svg" alt=""/>
    <h1>Login</h1>
    <?php if(isset($_GET["error"])): ?>
        <?php if ($_GET["error"] == STMT_ERR): ?>
            <p id="error-msg">Error: server error.</p>
        <?php elseif ($_GET["error"] == USER_NOT_FOUND): ?>
            <p id="error-msg">Error: a user with the entered username does not exist.</p>
        <?php elseif ($_GET["error"] == USER_ACCESS_DISABLED): ?>
            <p id="error-msg">Error: access is temporarily disabled as you have tried to access too many times with the wrong password.</p>
        <?php elseif ($_GET["error"] == WRONG_PASSWORD): ?>
            <p id="error-msg">Error: the entered password is wrong.</p>
        <?php endif; ?>
    <?php endif; ?>
    <form action="process_login.php" method="post">
        <ul>
            <li>
                <label for="username" hidden>Username</label>
                <input type="text" name="username" id="username" placeholder="Username" required/>
            </li>
            <li>
                <label for="password" hidden>Password</label>
                <input type="text" name="password" id="password" placeholder="Password" required/>
            </li>
        </ul>
        <input type="submit" value="Login"/>
    </form>
    <script src="js/sha512.js"></script>
    <script src="js/forms.js"></script>
    <p>You don't have an account? <a href="register.php">Register</a></p>
</main>