var posts = document.querySelectorAll(".open-focus");

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
              showPopover(this.responseText);
              addCloseListener();
              addLikeFunction();
          }
      }
        xhttp.send();
        
        });
});

addLikeFunction();

function showPopover(content) {
  var popover = document.createElement('div');
  popover.classList.add('popover');
  popover.innerHTML = content;
  document.body.appendChild(popover);
}

function addCloseListener() {
  let postFocus = document.querySelector(".post-focus");
  let closeFocus = document.querySelector(".close-focus");
  closeFocus.addEventListener("click", () => {
      postFocus.style.display =  "none";
  });
}

/*This part deals with the heart button*/
function addLikeFunction() {
  let heartIcon = document.querySelectorAll(".fa-heart");

  heartIcon.forEach((heart) => {
    heart.addEventListener("click", () => {
      heart.classList.toggle('fa-solid');
      heart.classList.toggle('fa-regular');
    })
  });
}
