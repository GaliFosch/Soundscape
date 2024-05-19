var posts = document.querySelectorAll(".open-focus");

posts.forEach((post) => {
  let heartIcon = document.querySelectorAll(".fa-heart");

  heartIcon.forEach((heart) => {
    heart.addEventListener('click', (event) => toggleColor(event,post))
  });


  post.addEventListener("click", () => {
        let postId = post.getAttribute('post-id');
        var xhttp;    
        xhttp = new XMLHttpRequest();
        xhttp.open("GET", "template/post_focus.php?post="+postId, true);
        xhttp.onreadystatechange = function() {
          if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
              // Add requested previews to section
              showPopover(this.responseText);
              addCloseListener();
              let focusHeartIcon = document.querySelectorAll(".fa-heart.focus");
              focusHeartIcon.forEach((focus) => {
                focus.addEventListener('click', (event) => toggleColor(event,post));
              });
          }
      }
        xhttp.send();
        
        });
});

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
function toggleColor(event, post) {
  console.log("grazie del clik");

      let targetHeart = event.target;
      let pairHeart = targetHeart.closest('.post-article') ? document.querySelector('.fa-heart.focus') : document.querySelector('.fa-heart.article');

      let postId = post.getAttribute('post-id');
      let xhttp;    
      xhttp = new XMLHttpRequest();
      xhttp.open("GET", "template/like_handler.php?post="+postId, true);
      xhttp.onreadystatechange = function() {
        if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
          console.log(this.responseText);
            if(this.responseText==="change") {
              console.log("grazie ");
                targetHeart.classList.toggle('fa-solid');
                targetHeart.classList.toggle('fa-regular');
                if(pairHeart!=null) {
                  pairHeart.classList.toggle('fa-solid');
                  pairHeart.classList.toggle('fa-regular');
                }
              }
              
            }
            
          }
      xhttp.send();  
}

