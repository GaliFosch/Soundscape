const player = document.getElementById("audio-player")
const progressBar = document.getElementById("audio-progress-bar")
const currentTimeLabel = document.getElementById("current-time-label")
const missingTimeLabel = document.getElementById("missing-time-label")
const playBtn = document.getElementById("play-button")
const rewindBtn = document.getElementById("rewind-button")

/*
 * Converts audio current time and duration to MM:SS format
 * Code taken from: https://stackoverflow.com/a/68988997
 */
function convertSeconds(sec) {
    let m = Math.floor(sec / 60);
    let s  = sec % 60;
    return (m < 10 ? "0" + m : m) + ":" + (s < 10 ? "0" + s : s);
}

function updateLabels() {
    currentTimeLabel.innerText = convertSeconds(Math.floor(player.currentTime))
    missingTimeLabel.innerText = "-" + convertSeconds(Math.floor(player.duration) - Math.floor(player.currentTime))
}

player.addEventListener("loadedmetadata", function () {
    updateLabels()
})

player.addEventListener("timeupdate", function () {
    progressBar.setAttribute("value", `${this.currentTime / this.duration}`)
    updateLabels()
})

playBtn.addEventListener("click", function () {
    if (player.paused) {
        player.play()
        playBtn.innerHTML = `<img src="images/pause-icon.svg" alt="Pause Button"/>`
    } else {
        player.pause()
        playBtn.innerHTML = `<img src="images/play-icon.svg" alt="Play Button"/>`
    }
})

rewindBtn.addEventListener("click", function () {
    player.currentTime = 0
    updateLabels()
})

/*
 * To make audio progress bar clickable and choose the point of the audio to go to
 * Code taken from: https://stackoverflow.com/a/32804559
 */
progressBar.addEventListener("click", function (event) {
    let ratio = event.offsetX / this.offsetWidth
    progressBar.value = ratio / 100
    player.currentTime = ratio * player.duration
    updateLabels()
})
