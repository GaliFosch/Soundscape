<main>
    <header>
        <h1>Upload a new track</h1>
    </header>
    <form id="new-resource-form" action="process_create_track.php" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <!-- Track title -->
                <label for="title" hidden></label>
                <input type="text" name="title" id="title" placeholder="Title" required />
            </li>
            <li>
                <label for="img">Cover image: </label>
                <input type="file" name="img" id="img" accept="image/*"/>
            </li>
            <li>
                <label for="audio">Audio file: </label>
                <input type="file" name="audio" id="audio" accept="audio/*" required/>
            </li>
        </ul>
        <input type="text" name="duration" id="audioDuration" hidden/>
    </form>
    <section>
        <header>
            <h3>Genres</h3>
        </header>
        <section id="GenreList">
            <section id="Selected"></section>
            <section id="NotSelected">
                <?php
                    $genres = $dbh->getAllGenres();
                    $i = 0;
                    foreach ($genres as $genre):
                        $i++;
                ?>
                    <button id="<?php echo $genre["GenreTag"]?>" class="genre">
                        <em class="fa-solid fa-check"></em>
                        <?php echo $genre["GenreTag"]?>
                    </button>
                <?php endforeach;?>
            </section>
        </section>
    </section>
    <input type="submit" form="new-resource-form" value="Create"/>
</main>
<script src="js/audioDuration.js"></script>
<script src="js/genreSelection.js"></script>