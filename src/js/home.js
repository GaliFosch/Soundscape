/*This part deals with the aside*/
var posts = document.querySelectorAll("article");
var postFocus = document.querySelector("aside");
var closeFocus = document.querySelector(".close-focus");

posts.forEach((post) => {
  post.addEventListener("click", () => {
    postFocus.style.display = postFocus.style.display === "none" ? "grid" : "grid";
  });
});

closeFocus.addEventListener("click", () => {
  postFocus.style.display = postFocus.style.display === "none" ? "grid" : "none";
});