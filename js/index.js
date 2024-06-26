let posts = document.querySelectorAll(".open-focus");
let comments = document.querySelectorAll(".fa-message");
let postComment = null;
let asideOpen = false;
let commentOpen = false;
let heartPairs = new Map();

const Popover = Object.freeze({
  Aside: 0,
  Footer:1
});

//Down here it deals with the post, the aside and the like functionality
posts.forEach((post) => {

  const closestHeart = post.closest('.post-article').querySelector('.fa-heart');
  closestHeart.addEventListener('click', (event) => toggleColor(event,post));
  post.addEventListener("click", () => {
    let postId = post.getAttribute('post-id');
    if(!asideOpen) {
      openAside(postId, closestHeart , post);
    } else {
      let closeFocus = document.querySelector(".close-focus");
      closeFocus.click();
      openAside(postId, closestHeart, post)
    } 
   });   
});

function openAside(postId, closestHeart, post) {
  asideOpen = true;
    let xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.open("GET", "template/post_focus.php?post="+postId, true);
    xhttp.onreadystatechange = function() {
      if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
          // Add requested previews to section
          showPopover(this.responseText, Popover.Aside, null);
          let focusHeartIcon = document.querySelector(".fa-heart.focus");
          addCloseListener(closestHeart,focusHeartIcon);
          heartPairs.set(closestHeart,focusHeartIcon);
          heartPairs.set(focusHeartIcon,closestHeart);
          focusHeartIcon.addEventListener('click', (event) => toggleColor(event,post));
      }
  }
    xhttp.send();
}

//This code deals with the popovers, both aside and footer
function showPopover(content, ver, below) {
  let popover;
  switch (ver) {
    case Popover.Aside:
      popover = document.createElement('aside');
      popover.classList.add('popover-aside');
      break;
    case Popover.Footer:
      popover = document.createElement('footer');
      popover.classList.add('popover-comment');
      break;
  }
  popover.classList.add('popover');
  popover.innerHTML = content;
  if(ver == Popover.Footer) {
    below.insertAdjacentElement('afterend', popover);
  } else {
    document.body.appendChild(popover);
  }
};

//This code deals with the close function both of the aside and the footer
function addCloseListener(heartIcon, heartIconPair) {
  let postFocus = document.querySelector(".popover-aside");
  let commentFocus = document.querySelector(".popover-comment");

  let closeFocus = document.querySelector(".close-focus");
  let closeComment = document.querySelector(".close-comment");

  if(postFocus!=null) {
    closeFocus.addEventListener("click", () => {
        postFocus.remove();
        asideOpen = false;
        if(heartIcon!=null && heartIconPair!=null) {
          heartPairs.delete(heartIcon);
          heartPairs.delete(heartIconPair);

      }
    });
  }
  if(commentFocus!=null) {
    closeComment.addEventListener("click", () => {
        commentFocus.remove();
        commentOpen = false;
        document.querySelector('body').style.overflow = "scroll";
    });
  }
};

/*This part deals with the heart button*/
function toggleColor(event, post) {
      let targetHeart = event.target;
      let pairHeart = heartPairs.get(targetHeart);

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
                  pairHeart.classList.toggle('fa-solid');
                  pairHeart.classList.toggle('fa-regular');
                }
              }
              
            }
            
          }
        console.log("Senza il login non puoi mettere like!");
      xhttp.send();  
};

//This code deals with the selection of the comments section or likes sections
//This is on a GUI type of way (it changes the colors and such)
function addSelectedListener() {
  let heart = document.querySelector(".like-changer-section");
  let comment = document.querySelector(".comment-changer-section");
  let selected = document.querySelector(".selected");

  heart.addEventListener("click", () => {
    selected.style.borderBottom = "0 solid";
  selected.querySelector("p").color = "#FFF";
  selected.querySelector("em").color = "#FFF";

    comment.classList.toggle('selected');
    heart.classList.toggle('selected');

    let sel = document.querySelector(".selected");
    sel.style.borderBottom = "0.2rem solid #E91E63";

    selected = sel;
  });

  comment.addEventListener("click", () => {
    selected.style.borderBottom = "0 solid";
  selected.querySelector("p").color = "#FFF";
  selected.querySelector("em").color = "#FFF";

    comment.classList.toggle('selected');
    heart.classList.toggle('selected');

    let sel = document.querySelector(".selected");
    sel.style.borderBottom = "0.2rem solid #1D70AD";

    selected = sel;
  });
  
};
//This is on a basic way, hide likes if comments and vice versa
function interactionViewerChanger() {
  let comment = document.querySelector(".comment-changer");
  let like = document.querySelector(".like-changer");
  let likeDiv = document.querySelector(".likes")
  let commentDiv = document.querySelector(".comments")

  comment.addEventListener("click", () => {
    likeDiv.style.display="none";
    commentDiv.style.display="block";
  })

  like.addEventListener("click", () => {
    commentDiv.style.display="none";
    likeDiv.style.display="block";
  })
};

//Down here it deals with the comment section
comments.forEach((comm) => {
    comm.addEventListener("click", () => {
        let postId = comm.getAttribute('post-id');
        console.log(postId);
        if(!commentOpen) {
          openComment(postId);
        } else if(commentOpen) {
          let closeFocus = document.querySelector(".close-comment");
          closeFocus.click();
          openComment(postId);
        }
   });
});

//This code deals with the opening of the comment. It send the request XHTML request
function openComment(postId) {
        commentOpen=true;
        let xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.open("GET", "template/comments.php?post="+postId, true);
        xhttp.onreadystatechange = function() {
          if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
              // Add requested previews to section
              let below = getSectionAbove(postId);
              showPopover(this.responseText, Popover.Footer, below);
              interactionViewerChanger();
              addCloseListener();
              addSelectedListener();
              if(window.innerWidth<768) {
                document.querySelector('body').style.overflow = "hidden";
              }
          }
      }
        xhttp.send();
}

//This code deals with the finding of the nearest section, under which the comment section is to open
function getSectionAbove(queryPostID) {
    for (let i = 0; i < comments.length; i++) {
        let postId = comments[i].getAttribute('post-id');
        if(queryPostID === postId) {
            return comments[i].closest('section');
        }
    }
}

//This code deals with comments reopening when a comment is added
window.onload= () => {
  const urlParams = new URLSearchParams(window.location.search);
  const myParam = urlParams.get('post');
  comments.forEach((comm) => {
    let postId = comm.getAttribute('post-id');
    if(postId == myParam) {
      openComment(postId);
    }
  })
}
    