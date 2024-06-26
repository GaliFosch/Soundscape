const commentFormContainer = document.getElementById("commentFormContainer");
const formDisplay = commentFormContainer.style.display;
const commentButton = document.getElementById("comment");

commentFormContainer.style.display = "none";
let hidden = true;

commentButton.addEventListener('click', ()=>{
    if(hidden){
        hidden = false;
        commentFormContainer.style.display = formDisplay;
    }else{
        hidden = true;
        commentFormContainer.style.display = "none";
    }
})