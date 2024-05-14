<main>
    <header>
        <?php 
            if(!empty($template["profile"]["ProfileImage"])){
                echo "<img src=\"{$template["profile"]["ProfileImage"]}\" alt=\"\" \>";
            }else{
                //playsolder
            }
        ?>
        <h2><?php echo $template["profile"]["Username"]?></h2>
    </header>
    <section>
        <h3>Canzoni Pubblicate</h3>
        <!-- canzoni Pubblicate -->
    </section>
    <section>
        <h3>Playlist Pubblicate</h3>
        <!-- Playlist Pubblicate -->
    </section>
    <section>
        <h3>Migliori Post</h3>
        <!-- Migliori Post -->
    </section>
</main>