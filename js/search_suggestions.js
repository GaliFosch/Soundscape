let sugg = document.querySelector('.track-suggestions');
let search = document.querySelector('#track-search');
let trackSearchForm = document.getElementById("track-search-form")

let tracksOnly = false;
let userTracksOnly = false;

/*
 * Function code taken from: https://www.tabnine.com/academy/javascript/how-to-get-cookies/
 */
function getCookie(cName) {
    const name = cName + "=";
    const cDecoded = decodeURIComponent(document.cookie); //to be careful
    const cArr = cDecoded.split('; ');
    let res;
    cArr.forEach(val => {
        if (val.indexOf(name) === 0) {
            res = val.substring(name.length);
        }
    })
    return res
}

if (trackSearchForm.classList.contains("filter-by-selected-collection-type")) {

    let albumRadioBtn = document.getElementById("album-option")
    let playlistRadioBtn = document.getElementById("playlist-option")
    if (albumRadioBtn != null) {
        albumRadioBtn.addEventListener("change", function() {
            userTracksOnly = albumRadioBtn.checked;
        })
    }
    if (playlistRadioBtn != null) {
        playlistRadioBtn.addEventListener("change", function() {
            userTracksOnly = false
            tracksOnly = playlistRadioBtn.checked
        })
    }

} else if (trackSearchForm.classList.contains("tracks-only")) {
    tracksOnly = true
} else if (trackSearchForm.classList.contains("user-tracks-only")) {
    userTracksOnly = true
}

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
                    if (userTracksOnly && (results[i].Creator !== getCookie("logged_user"))) {
                        continue
                    }
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