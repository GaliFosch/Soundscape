const likeButton = document.getElementById("like");
const postID = URLSearchParams(window.location.search).get('id');
likeButton.addEventListener("click", () =>{
    fetch("template/like_handler.php?post=".postID)
})