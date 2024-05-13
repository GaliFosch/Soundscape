/*This part deals with the aside*/
var posts = document.querySelectorAll(".open-focus");
var postFocus = document.querySelector("aside");
var closeFocus = document.querySelector(".close-focus");

posts.forEach((post) => {
  post.addEventListener("click", () => {
    console.log("Mi hai cliccato");
    postFocus.style.display = postFocus.style.display === "none" ? "grid" : "grid";
  });
});

closeFocus.addEventListener("click", () => {
  postFocus.style.display = postFocus.style.display === "none" ? "grid" : "none";
});

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