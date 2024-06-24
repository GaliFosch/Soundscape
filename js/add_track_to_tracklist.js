let addTrackBtn = document.getElementById("add-track-button")
let searchBar = document.getElementById("track-search")
let selectedTracksSection = document.getElementById("selected-tracks")

addTrackBtn.addEventListener("click", function() {

    let trackString = searchBar.value
    let trackInfo = trackString.split(" - ")
    trackInfo.forEach(str => str.toLowerCase())

    const request = new XMLHttpRequest()
    request.open(
        "GET",
        "get_preview_by_track_info.php?title=" + trackInfo[0] + "&author=" + trackInfo[1],
        true
    )
    request.onreadystatechange = function() {
        if ((this.readyState === 4) && (this.status === 200)) {
            selectedTracksSection.innerHTML += this.response
        }
    }
    request.send()

})
