<?php
require_once("bootstrap.php");

if(!checkLogin($dbh)){
    echo "false";
    exit();
}

$creator = $dbh->getUserByUsername($_SESSION["username"]);

?>
<?php if ($creator["ProfileImage"] != null): ?>
        <img class="profile-picture" src="<?php echo $creator["ProfileImage"]; ?>" alt="Comment creator profile image"/>
    <?php else: ?>
        <img class="profile-picture" src="images/placeholder-image.jpg" alt="Comment creator profile image"/>
<?php endif; ?>
<a href="profile.php?profile=<?php echo $creator["Username"]; ?>" class="redirect">
    <p id="<?php echo $creator["Username"]; ?>"><b><?php echo $creator["Username"]?></b></p>
</a>