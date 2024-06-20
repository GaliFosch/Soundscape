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
                <input type="file" name="img" id="img"/>
            </li>
            <li>
                <label for="audio">Select The File Audio</label>
                <input type="file" name="audio" id="audio" required />
            </li>
        </ul>
        <input type="submit" value="Create" />
    </form>
</main>