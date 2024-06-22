let tracklistItems = document.getElementsByClassName("tracklist-item")

for (let i = 0; i < tracklistItems.length; i++) {
    tracklistItems[i].addEventListener("mouseover", function() {
        let trackOptions = tracklistItems[i].getElementsByClassName("track-options")[0]
        trackOptions.style.visibility = "visible"
    })
    tracklistItems[i].addEventListener("mouseout", function() {
        let trackOptions = tracklistItems[i].getElementsByClassName("track-options")[0]
        trackOptions.style.visibility = "hidden"
    })
}