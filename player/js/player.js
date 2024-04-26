const player = document.getElementById("audio-player")
const progressBar = document.getElementById("audio-progress-bar")
const currentTimeLabel = document.getElementById("current-time-label")
const missingTimeLabel = document.getElementById("missing-time-label")
const playBtn = document.getElementById("play-button")

function convertSeconds(sec) {
    let m = Math.floor(sec / 60);
    let s  = sec % 60;
    return (m < 10 ? "0" + m : m) + ":" + (s < 10 ? "0" + s : s);
}

player.addEventListener("loadedmetadata", function () {
    currentTimeLabel.innerText = convertSeconds(Math.floor(player.currentTime))
    missingTimeLabel.innerText = "-" + convertSeconds(Math.floor(player.duration))
})

player.addEventListener("timeupdate", function () {
    progressBar.setAttribute("value", `${this.currentTime / this.duration}`)
    currentTimeLabel.innerText = convertSeconds(Math.floor(this.currentTime))
    missingTimeLabel.innerText = "-" + convertSeconds(Math.floor(this.duration) - Math.floor(this.currentTime))
})

playBtn.addEventListener("click", function () {
    if (player.paused) {
        player.play()
        playBtn.innerHTML = `<img src="images/pause-icon.png" alt="Pause Button"/>`
    } else {
        player.pause()
        playBtn.innerHTML = `<img src="images/play-icon.png" alt="Play Button"/>`
    }
})
