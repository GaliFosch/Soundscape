let sugg = document.querySelector('.track-suggestions');
let search = document.querySelector('#track-search');

/*This code deals with the search suggestion */
search.addEventListener('keydown', function(event) {
    let search_text = event.target.value;
    let xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.open("GET", "template/track_search.php?query="+search_text, true);
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
                let type = (results[i].IsAlbum !== 0) ? "Album" : (results[i].PlaylistId != null ? "Playlist" : "Track");
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

        //idk why this doesn't work
        li.addEventListener("mouseover", (event)=>{
            li.style.backgroundColor = "#1D70AD";
        });

        li.addEventListener("mouseout", (event)=>{
            li.style.backgroundColor = "";
        });
    });
}
/*Here ends the code deals with the search suggestion */