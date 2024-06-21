document.getElementById('audio').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const audio = new Audio(URL.createObjectURL(file));
        audio.addEventListener('loadedmetadata', function() {
            const duration = audio.duration;
            document.getElementById('audioDuration').value = `00:${Math.floor(duration / 60)}:${Math.floor(duration % 60).toString().padStart(2, '0')}`;
        });
    }
});