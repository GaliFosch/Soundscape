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
</main>