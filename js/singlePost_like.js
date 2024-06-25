const likeButton = document.getElementById("like");
const postID =  new URLSearchParams(window.location.search).get('id');

likeButton.addEventListener("click", () =>{
    fetch("./template/like_handler.php?post="+postID)
        .then((response)=>response.text())
        .then((response)=>{
            if(response === "change"){
                likeButton.classList.toggle("fa-regular");
                likeButton.classList.toggle("fa-solid");
            }
        })
})