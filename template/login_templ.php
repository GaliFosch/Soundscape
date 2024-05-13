<main>
    <img src="images/logo.svg" alt=""/>
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
    <script type="text/javascript" src="js/sha512.js"></script>
    <script type="text/javascript" src="js/forms.js"></script>
    <p>You dont have an account? <a href="register.php">register</a></p>
</main>