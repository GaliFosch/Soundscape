<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $template["title"]; ?></title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            if (!empty($template["style"])) {
                echo "<link href=\"". "css/" . $template["style"] ."\" type=\"text/css\" rel=\"stylesheet\" />";
            }
        ?>
    </head>
    <body>
        <!-- Navigation menu -->
        <nav>
            <img src="images/logo.svg" alt=""/>
            <ul>
                <li><a href="index.php" aria-label="Go to home page" title="Go to home page"><em class="fa-solid fa-house" aria-hidden="true"></em><p>Home</p></a></li>
                <li><a href="discover.php" aria-label="Search" title="Search"><em class="fa-solid fa-magnifying-glass" aria-hidden="true"></em><p>Discover</p></a></li>
                <li><a href="#" aria-label="Go to notifications page" title="Go to notifications page"><em class="fa-solid fa-bell" aria-hidden="true"></em><p>Notifications</p></a></li>
                <li><a href="player.php" aria-label="Go to music player" title="Go to music player"><em class="fa-solid fa-music" aria-hidden="true"></em><p>Music player</p></a></li>
                <li><a href="profile.php" aria-label="Go to your profile" title="Go to your profile">
                    <?php if(!empty($_SESSION['user']['Immagine'])): ?>
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_SESSION['user']['Immagine']); ?>" alt="" />
                    <?php else: ?>
                        <em class="fa-solid fa-user" aria-hidden="true"></em>
                    <?php endif; ?>
                    <p>Your profile</p>
                </a></li>
            </ul>
        </nav>
        <!-- Content -->
        <?php require($template["content"]); ?>
        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/06a34675f0.js" crossorigin="anonymous"></script>
    </body>
</html>