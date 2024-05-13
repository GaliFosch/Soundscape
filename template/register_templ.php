<main>
    <h2>Registration</h2>
    <form action="#" method="POST">
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
                <textarea name="biography" id="biography" placeholder="Write here your biography"></textarea>
            </li>
            <li>
                <label for="image">Image</label>
                <input type="file" name="image" id="image"/>
            </li>
        </ul>
        <input type="submit" value="Register"/>
    </form>
    <script type="text/javascript" src="js/sha512.js"></script>
    <script type="text/javascript" src="js/forms.js"></script>
</main>