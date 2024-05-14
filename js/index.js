/*This part deals with the aside*/
var posts = document.querySelectorAll(".open-focus");
//var postFocus = document.querySelector("aside");
//var closeFocus = document.querySelector(".close-focus");

posts.forEach((post) => {
  post.addEventListener("click", () => {
    console.log("Cliccato");
        let postId = post.getAttribute('post-id');
        console.log(postId);
        var xhttp;    
        xhttp = new XMLHttpRequest();
        xhttp.open("GET", "template/post_focus.php?post="+postId, true);
        xhttp.onreadystatechange = function() {
          if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
              // Add requested previews to section
              console.log("hey")
              document.body.innerHTML += this.responseText;
          }
      }
        xhttp.send();
        });
});

/*closeFocus.addEventListener("click", () => {
  postFocus.style.display = postFocus.style.display === "none" ? "grid" : "none";
});*/

/*This part deals with the heart button*/
var heartFull = document.querySelectorAll(".fa-regular.fa-heart");
var heartEmpty = document.querySelectorAll(".fa-solid.fa-heart");

heartFull.forEach((heart) => {
  heart.addEventListener("click", () => {
    console.log("Mi hai cliccato");
    heart.classList.toggle('fa-solid');
    heart.classList.toggle('fa-regular');
  })
});