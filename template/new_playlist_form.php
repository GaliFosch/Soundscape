<main>
    <header>
        <h1>Create a new album or playlist</h1>
    </header>
    <form id="new-resource-form" action="process_playlist_creation.php" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <!-- Playlist title -->
                <label for="title" hidden></label>
                <input type="text" name="title" id="title" placeholder="Title" required />
            </li>
            <li>
                <!-- Cover image -->
                <label for="image">Cover image: </label>
                <input type="file" name="image" id="image"/>
            </li>
            <li>
                <!-- Album or playlist -->
                <div class="collection-option">
                    <input id="album-option" type="radio" name="collection-type" value="album" />
                    <label for="album-option">Album</label>
                </div>
                <div class="collection-option">
                    <input id="playlist-option" type="radio" name="collection-type" value="playlist" />
                    <label for="playlist-option">Playlist</label>
                </div>
            </li>
        </ul>
    </form>
    <form id="track-search-form" action="post_creation.php?" method="GET" class="comment" autocomplete="off">
        <label for="track-search"></label>
        <input id="track-search" type="search" name="track" placeholder="Search for song"/>
        <input id="track-search-button" type="submit" class="searchButton" value="Search" />
        <em class="fa-solid fa-magnifying-glass"></em>
    </form>
    <section class="track-suggestions-section">
        <ul class="track-suggestions"></ul>
    </section>
    <input type="submit" value="Create" />
</main>
<script src="js/search_suggestions.js"></script>