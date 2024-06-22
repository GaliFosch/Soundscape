let tracklistRows = document.getElementsByClassName("row")
let removeTrackButtons = document.getElementsByClassName("remove-track-button")

for (let i = 0; i < removeTrackButtons.length; i++) {

    removeTrackButtons[i].disabled = true;

    removeTrackButtons[i].addEventListener("click", function(event) {
        let isRemovalConfirmed = confirm("Are you sure that you want to remove the track from this album/playlist?")
        if (!isRemovalConfirmed) {
            event.preventDefault()
        }
    })

}

for (let i = 0; i < tracklistRows.length; i++) {

    tracklistRows[i].addEventListener("mouseover", function() {
        let trackOptions = tracklistRows[i].getElementsByClassName("track-options")[0]
        let removeTrackBtn = trackOptions.getElementsByClassName("remove-track-button")[0]
        trackOptions.style.visibility = "visible"
        removeTrackBtn.disabled = false;
    })

    tracklistRows[i].addEventListener("mouseout", function() {
        let trackOptions = tracklistRows[i].getElementsByClassName("track-options")[0]
        let removeTrackBtn = trackOptions.getElementsByClassName("remove-track-button")[0]
        trackOptions.style.visibility = "hidden"
        removeTrackBtn.disabled = true;
    })

}
