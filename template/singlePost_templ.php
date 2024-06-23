<main>
    <header>
        <?php if(empty($template["author"]["ProfileImage"])): ?>
            <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
        <?php else: ?>
            <img class="picture" src="<?php echo $template["author"]["ProfileImage"]; ?>" alt="User profile image"/>
        <?php endif;?>
        <h2><?php echo $template["author"]["Username"]; ?></h2>
    </header>
    <main>
        <p><?php echo $template["post"]["Caption"]; ?></p>
        <?php if(!empty($template["track"])):?>
            <div class="trackSection">
                <?php if(empty($template["track"]["CoverImage"])): ?>
                    <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
                <?php else: ?>
                    <img class="picture" src="<?php echo $template["track"]["CoverImage"]; ?>" alt="User profile image"/>
                <?php endif;?>
                <h3><?php echo $template["track"]["Name"]; ?></h3>
                <p><?php echo $template["track"]["Creator"]; ?></p>
            </div>
        <?php elseif(!empty($template["plailist"])):?>
            <div class="playlistSection">
                <?php if(empty($template["playlist"]["CoverImage"])): ?>
                    <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
                <?php else: ?>
                    <img class="picture" src="<?php echo $template["playlist"]["CoverImage"]; ?>" alt="User profile image"/>
                <?php endif;?>
            </div>
        <?php endif;?>
    </main>
</main>