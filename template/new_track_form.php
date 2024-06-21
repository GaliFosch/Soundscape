<main>
    <header>
        <h1>Upload a new track</h1>
    </header>
    <form id="new-resource-form" action="process_create_track.php" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="title" hidden>Title</label>
                <input type="text" name="title" id="title" placeholder="Title" required />
            </li>
            <li>
                <label for="img">Select an Image</label>
                <input type="file" name="img" id="img" accept="image/*"/>
            </li>
            <li>
                <label for="audio">Select The File Audio</label>
                <input type="file" name="audio" id="audio" accept="audio/*" required/>
            </li>
        </ul>
        <input type="text" name="duration" id="audioDuration" hidden/>
        <input type="submit" value="Create" />
    </form>
    <section>
        <header>
            <h3>Genres</h3>
        </header>
        <main id="GenreList">
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
        </main>
        <script src="js/genreSelection.js"></script>
    </section>
    <input type="submit" form="createTrack" value="Send"/>
</main>
<script src="js/audioDuration.js"></script>