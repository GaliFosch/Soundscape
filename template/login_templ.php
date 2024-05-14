<main>
    <img id="front-logo" src="images/logo.svg" alt=""/>
    <h1>Login</h1>
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