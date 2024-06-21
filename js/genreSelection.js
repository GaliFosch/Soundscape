const form = document.getElementById("createTrack");
const genrelist = document.getElementById("GenreList");
const selected = document.getElementById("Selected");
const notSelected = document.getElementById("NotSelected");
const genres = Array.from(notSelected.getElementsByClassName("genre"));

function insertValueIntoForm(value){
    const element = document.createElement("input");
    element.className = "genre";
    element.type = "text";
    element.name = "genres[]";
    element.value = value;
    element.id = value;
    form.append(element);
}

function removeValueFromForm(value){
    form.removeChild(document.getElementById(value));
}

function insertAlphabetically(container, element){
    let inserted = false;
    const list = container.children;
    for(let i = 0; i<list.length; i++){
        if(element.textContent.localeCompare(list[i].textContent)<0){
            container.insertBefore(element, list[i]);
            inserted = true;
            break;
        }
    }
    if(!inserted){
        container.append(element);
    }
}

genres.forEach(genre=>{
    genre.addEventListener("click", function(){
        if(selected.contains(genre)){
            selected.removeChild(genre);
            insertAlphabetically(notSelected, genre);
            removeValueFromForm(genre.id);
        }else{
            notSelected.removeChild(genre);
            insertAlphabetically(selected, genre)
            insertValueIntoForm(genre.id);
        }
    })
})