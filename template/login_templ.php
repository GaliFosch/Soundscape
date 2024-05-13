<main>
    <img src="images/logo.svg" alt=""/>
    <form action="process_login.php" method="post">
        <ul>
            <li>
                <label for="username" hidden>Username</label>
                <input type="text" name="username" id="username" placeholder="Username"/>
            </li>
            <li>
                <label for="password" hidden>Password</label>
                <input type="text" name="password" id="password" placeholder="Password"/>
            </li>
        </ul>
        <input type="submit" value="Login"/>
    </form>
</main>