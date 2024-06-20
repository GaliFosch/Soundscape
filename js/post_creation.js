
let sugg = document.querySelector('.track-suggestions');
let search = document.querySelector('#search-track');
let remove = document.querySelector('.remove');
let fileInput = document.getElementById('images');
let firstTime = 0;
let files ;

search.addEventListener('keydown', function(event) {
    firstTime++;
    if(firstTime>1) {
        let search_text = event.target.value;
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.open("GET", "template/track_search.php?query="+search_text, true);
        xhttp.onreadystatechange = function() {
            if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
                let results = JSON.parse(this.responseText);
                console.log(results);
                let html = '';
                for(let i = 0; i < results.length; i++) {
                    let start = '<li>';
                    let end = '</li>';
                    let img = results[i].CoverImage != null 
                            ? '<img class="song-icon" src="' + results[i].CoverImage + '" alt="Song cover image" />' 
                            : '<img class="song-icon" src="images/placeholder-image.jpg" alt="Song cover image"/>';
                    let type = results[i].IsAlbum != 0 ? "Album" : (results[i].PlaylistId != null ? "Playlist" : "Track");
                    let p = '<p>' + results[i].Name + ' - ' + results[i].Creator + ' - ' + type + '</p>';
                    html += start + img + p + end;
                }
                sugg.innerHTML= html;
                listEvent();
            }
        }
        xhttp.send();
    }
    
});

function listEvent() {
    let list = document.querySelectorAll('li');
    list.forEach((li) => {
        li.addEventListener("click", (event)=>{
            let target = event.target;
            let text = target.closest('p').textContent;
            let searchButton = document.querySelector(".searchButton");
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
};
 
if(remove!=null) {
    remove.addEventListener("click", ()=> {
        var url = window.location.href;

        // Parse the URL
        var urlParts = url.split('?');
        var query = urlParts[1];

        // Check if the query string contains 'track'
        if (query.includes('track')) {
        // Update the URL
        window.location.href = urlParts[0];
        }  
    });  
}

fileInput.addEventListener('change', (event) => {
  files = event.target.files;
  if (files.length > 10) {
    alert('You can only select up to 10 files');
    event.target.value = '';
  } else {

    let section = document.createElement('section');
    section.classList.add = "selected-image-viewer";    
    let main = document.querySelector('main');

    files.forEach((element) => {   
        let inner = document.createElement('section');
        let img = document.createElement('img');
        let em = document.createElement('em');

        inner.classList.add = "inner-image-viewer"
        img.classList.add = "selected-image";
        em.classList.add = "fa-solid fa-xmark";
        img.src = URL.createObjectURL(element);

        inner.appendChild(img);
        inner.appendChild(em);
        section.appendChild(inner);
    });
    main.appendChild(section);

    let deleteImage = section.querySelectorAll(".fa-close");
    deleteImage.forEach((em) => {
        em.addEventListener("click", (event) => {
            let imageToDelete = event.target.closest("img");
            imageToDelete.
        } )
    })

  }
  
});