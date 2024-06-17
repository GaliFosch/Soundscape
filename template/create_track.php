<main>
    <h2>Create a Track</h2>
    <form action="process_create_track.php" method="POST" enctype="multipart/form-data">
        <label for="title" hidden>Title</label>
        <input type="text" name="title" id="title" placeholder="Title" require/>
        <label for="img" hidden>Image</label>
        <input type="file" name="img" id="img"/>
        <label for="audio" hidden>File Audio</label>
        <input type="file" name="audio" id="audio" require/>
        <input type="submit" value="Send"/>
    </form>
</main>