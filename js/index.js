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
              let heartIcon = document.querySelectorAll(".fa-heart.focus");

              heartIcon.forEach((heart) => {
                heart.addEventListener("click", () => {
                  let postId = post.getAttribute('post-id');
                  let innerXhttp;    
                  innerXhttp = new XMLHttpRequest();
                  innerXhttp.open("GET", "template/like_handler.php?post="+postId, true);
                  innerXhttp.onreadystatechange = function() {
                    if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
                        console.log(ok);
                        heart.classList.toggle('fa-solid');
                        heart.classList.toggle('fa-regular');
                      }
                    }
                    innerXhttp.send();
                })
              });
          }
      }
        xhttp.send();
        
        });
});

addLikeFunction();

function showPopover(content) {
  let popover = document.createElement('aside');
  popover.classList.add('popover');
  popover.innerHTML = content;
  document.body.appendChild(popover);
}

function addCloseListener() {
  let postFocus = document.querySelector(".popover");
  let closeFocus = document.querySelector(".close-focus");
  closeFocus.addEventListener("click", () => {
      postFocus.remove();
  });
}

/*This part deals with the heart button*/
function addLikeFunction(post) {
  let heartIcon = document.querySelectorAll(".fa-heart");

  heartIcon.forEach((heart) => {
    heart.addEventListener("click", () => {
      let postId = post.getAttribute('post-id');
      let xhttp;    
      xhttp = new XMLHttpRequest();
      xhttp.open("GET", "template/like_handler.php?post="+postId, true);
      xhttp.onreadystatechange = function() {
        if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
            console.log(ok);
            heart.classList.toggle('fa-solid');
            heart.classList.toggle('fa-regular');
          }
        }
      xhttp.send();  
    }
    );
  });
}
