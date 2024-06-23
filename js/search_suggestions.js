let sugg = document.querySelector('.track-suggestions');
let search = document.querySelector('#track-search');
let trackSearchForm = document.getElementById("track-search-form")

let tracksOnly = false;
let userTracksOnly = false;

if (trackSearchForm.classList.contains("filter-by-selected-collection-type")) {

    let albumRadioBtn = document.getElementById("album-option")
    let playlistRadioBtn = document.getElementById("playlist-option")
    if (albumRadioBtn != null) {
        albumRadioBtn.addEventListener("change", function() {
            userTracksOnly = albumRadioBtn.checked;
        })
    } else if (playlistRadioBtn != null) {
        playlistRadioBtn.addEventListener("change", function() {
            tracksOnly = playlistRadioBtn.checked
        })
    }

} else if (trackSearchForm.classList.contains("tracks-only")) {
    tracksOnly = true
} else if (trackSearchForm.classList.contains("user-tracks-only")) {
    userTracksOnly = true
}

/*This code deals with the search suggestion */
search.addEventListener('keydown', function(event) {
    let search_text = event.target.value;
    let xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.open(
        "GET",
        "template/track_search.php?query=" + search_text,
        true
    );
    xhttp.onreadystatechange = function() {
        if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
            let results = JSON.parse(this.responseText);
            console.log(results);
            let html = '';
            for(let i = 0; i < results.length; i++) {
                let start = '<li>';
                let img = (results[i].CoverImage != null)
                    ? '<img class="song-icon" src="' + results[i].CoverImage + '" alt="Song cover image" />'
                    : '<img class="song-icon" src="images/placeholder-image.jpg" alt="Song cover image"/>';
                let type = null
                if (results[i].IsAlbum === 1) {
                    if (!tracksOnly && !userTracksOnly) {
                        type = "Album"
                    } else {
                        continue
                    }
                } else if (results[i].IsAlbum === 0) {
                    if (!tracksOnly && !userTracksOnly) {
                        type = "Playlist"
                    } else {
                        continue
                    }
                } else {
                    type = "Track"
                }
                let p = '<p>' + results[i].Name + ' - ' + results[i].Creator + ' - ' + type + '</p>';
                let end = '</li>';
                html += start + img + p + end;
            }
            sugg.innerHTML= html;
            listEvent();
        }
    }
    xhttp.send();
});

/*This code deals with the search suggestion */
function listEvent() {

    let list = document.querySelectorAll('li');

    list.forEach((li) => {

        li.addEventListener("click", (event)=>{
            let target = event.target;
            let text = target.closest('p').textContent;
            search.value = text;
            sugg.innerHTML = ""
        });

        li.addEventListener("mouseover", (event)=>{
            li.style.backgroundColor = "#1D70AD";
        });

        li.addEventListener("mouseout", (event)=>{
            li.style.backgroundColor = "";
        });

    });

}
/*Here ends the code deals with the search suggestion */