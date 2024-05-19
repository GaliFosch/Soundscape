let posts = document.querySelectorAll(".open-focus");
let asideOpen = false;
let heartPairs = new Map();

posts.forEach((post) => {

  const closestHeart = post.closest('.post-article').querySelector('.fa-heart');
  console.log(closestHeart)
  let heartIcon = post.querySelector(".fa-heart");
  closestHeart.addEventListener('click', (event) => toggleColor(event,post));


  post.addEventListener("click", () => {
    if(!asideOpen) {
        let postId = post.getAttribute('post-id');

        var xhttp;    
        xhttp = new XMLHttpRequest();
        xhttp.open("GET", "template/post_focus.php?post="+postId, true);
        xhttp.onreadystatechange = function() {
          if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
              // Add requested previews to section
              showPopover(this.responseText);
              let focusHeartIcon = document.querySelector(".fa-heart.focus");
              addCloseListener(closestHeart,focusHeartIcon);
              heartPairs.set(closestHeart,focusHeartIcon);
              heartPairs.set(focusHeartIcon,closestHeart);
              console.log(heartPairs);
              focusHeartIcon.addEventListener('click', (event) => toggleColor(event,post));
              asideOpen = !asideOpen;
          }
      }
        xhttp.send();
    }  
   });
      
});

function showPopover(content) {
  let popover = document.createElement('aside');
  popover.classList.add('popover');
  popover.innerHTML = content;
  document.body.appendChild(popover);
}

function addCloseListener(heartIcon, heartIconPair) {
  let postFocus = document.querySelector(".popover");
  let closeFocus = document.querySelector(".close-focus");
  closeFocus.addEventListener("click", () => {
      postFocus.remove();
      asideOpen = !asideOpen;
      heartPairs.delete(heartIcon);
      heartPairs.delete(heartIconPair);
  });
}

/*This part deals with the heart button*/
function toggleColor(event, post) {
  console.log("grazie del clik");

      let targetHeart = event.target;
      let pairHeart = heartPairs.get(targetHeart);
      console.log(targetHeart);
      console.log(pairHeart);

      let postId = post.getAttribute('post-id');
      let xhttp;    
      xhttp = new XMLHttpRequest();
      xhttp.open("GET", "template/like_handler.php?post="+postId, true);
      xhttp.onreadystatechange = function() {
        if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {

            if(this.responseText==="change") {
                
                targetHeart.classList.toggle('fa-solid');
                targetHeart.classList.toggle('fa-regular');
                if(pairHeart!=null) {
                  console.log("ghello");
                  pairHeart.classList.toggle('fa-solid');
                  pairHeart.classList.toggle('fa-regular');
                }
              }
              
            }
            
          }
      xhttp.send();  
}

