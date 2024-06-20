<main>
    <h2>Create a Track</h2>
    <form action="process_create_track.php" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="title" hidden>Title</label>
                <input type="text" name="title" id="title" placeholder="Title" require/>
            </li>
            <li>
                <label for="img">Select an Image</label>
                <input type="file" name="img" id="img"/>
            </li>
            <li>
                <label for="audio">Select The File Audio</label>
                <input type="file" name="audio" id="audio" require/>
            </li>
        </ul>
        <input type="submit" value="Send"/>
    </form>
    <section>
        <header>
            <h3>Genres</h3>
        </header>
        <main id="GenreList">
            <?php 
                $genres = $dbh->getAllGenres();
                $i = 0;
                foreach ($genres as $genre):
                    $i++;
            ?>
                <button class="genre" original-index = "<?php echo $i;?>">
                    <em class="fa-solid fa-check"></em>
                    #<?php echo $genre["GenreTag"]?>
                </button>
            <?php endforeach;?>
        </main>
    </section>
</main>