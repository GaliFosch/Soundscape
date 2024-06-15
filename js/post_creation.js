
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
                let html = "";
                for(let i = 0; i < results.length; i++) {
                    html += '<div>' + results[i].Name + '</div>';
                }
                sugg.innerHTML= html;
            }
        }
        xhttp.send();
    }
    
});
 