<main>
    <img id="front-logo" src="images/logo.svg" alt=""/>
    <h1>Registration</h1>
    <form id="user-info-form" action="process_register.php" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="username" hidden>Username</label>
                <input type="text" name="username" id="username" placeholder="Username" required/>
            </li>
            <li>
                <label for="password" hidden>Password</label>
                <input type="text" name="password" id="password" placeholder="Password" required/>
            </li>
            <li>
                <label for="email" hidden>Email</label>
                <input type="text" name="email" id="email" placeholder="Email" required/>
            </li>
            <li>
                <label for="biography" hidden>Biography</label>
                <textarea name="biography" id="biography" rows="5" placeholder="Write here your biography" required></textarea>
            </li>
            <li>
                <label for="image">Profile image: </label>
                <input type="file" name="image" id="image"/>
            </li>
        </ul>
        <input id="submit-btn" type="submit" value="Register"/>
    </form>
    <script src="js/sha512.js"></script>
    <script src="js/forms.js"></script>
</main>