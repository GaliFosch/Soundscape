<!-- Search bar -->
<header>
    <form action="#" method="GET">
        <em class="fa-solid fa-magnifying-glass" aria-hidden="true"></em>
        <label for="search-bar">Search</label>
        <input id="search-bar" type="search" name="query"/>
        <input type="submit" value="Go"/>
    </form>
</header>
<!-- Search results and suggestions -->
<main>
    <?php if (isset($_GET["query"]) && ($_GET["query"] != "")): ?>
        <section class="search-results">
            <h1>Users</h1>
            <?php $users = $dbh->getMatchingUsers($_GET["query"]); ?>
            <?php foreach ($users as $user): ?>
                <section class="result-preview">
                    <a href="#">
                        <?php if ($user["ProfileImage"] != null): ?>
                            <img class="profile-picture" src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
                        <?php else: ?>
                            <img class="profile-picture" src="images/placeholder-image.jpg" alt="User profile image"/>
                        <?php endif; ?>
                        <h2><?php echo $user["Username"]; ?></h2>
                    </a>
                </section>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
</main>