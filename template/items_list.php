<header class="list-title">
    <h1><?php echo $_GET["t"]; ?> by <?php echo $_SESSION["username"]; ?></h1>
</header>
<main>
    <section>
        <?php require("get_previews.php"); ?>
    </section>
</main>
