
let sugg = document.querySelector('.track-suggestions');
let search = document.querySelector('#search-track');
let firstTime = 0;

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
                    let p = '<p>' + results[i].Name + ' - ' + results[i].Creator + '</p>';
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
            searchButton.click();
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
 