const player = document.getElementById("audio-player")
const playBtn = document.getElementById("play-button")

playBtn.addEventListener("click", function () {
    if (player.paused) {
        player.play()
        playBtn.innerHTML = `<img src="images/pause-icon.png" alt="Pause Button"/>`
    } else {
        player.pause()
        playBtn.innerHTML = `<img src="images/play-icon.png" alt="Play Button"/>`
    }
})
