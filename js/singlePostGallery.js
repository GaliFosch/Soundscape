const imgContainer = document.getElementById("imgSection");
const imgs = Array.from(imgContainer.getElementsByTagName("img"));

const previousButton = document.getElementById("previousImg");
const nextButton = document.getElementById("nextImg");

for(let i = 1; i<imgs.length; i++) imgs[i].style.display = "none"
previousButton.style.display="none";

let selected = 0;

previousButton.addEventListener("click", ()=>{
    imgs[selected].style.display="none";
    selected--;
    imgs[selected].style.display="";
    if(selected === 0){
        previousButton.style.display = "none";
    }
    if(nextButton.style.display === "none"){
        nextButton.style.display = "";
    }
})

nextButton.addEventListener("click", ()=>{
    imgs[selected].style.display="none";
    selected++;
    imgs[selected].style.display="";
    if(selected === imgs.length-1){
        nextButton.style.display = "none";
    }
    if(previousButton.style.display === "none"){
        previousButton.style.display = "";
    }
})
