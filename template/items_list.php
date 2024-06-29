<header class="list-title">
    <h1><?php echo $template["heading"]; ?></h1>
</header>
<main>
    <?php require("get_previews.php"); ?>
</main>
<?php if ($_GET["t"] == "posts"): ?>
    <script src="js/index.js"></script>
<?php endif; ?>
