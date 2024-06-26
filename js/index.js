let posts = null;
let comments = null;
let postComment = null;
let asideOpen = false;
let numAside = null;
let commentOpen = false;
let numComment = null;
let heartPairs = new Map();

const Popover = Object.freeze({
  Aside: 0,
  Footer:1
});

window.onload = () => {
  posts = document.querySelectorAll(".open-focus");
  comments = document.querySelectorAll(".fa-message");
  

  posts.forEach((post) => {
    const closestHeart = post.closest('.post-article').querySelector('.fa-heart');
    closestHeart.addEventListener('click', (event) => toggleColor(event,post));
    let article = post.closest("article");
    post.addEventListener("click", () => {
      let postId = article.id;
      if(!asideOpen) {
        openAside(postId, closestHeart , post);
      } else if(numAside==postId) {
        let closeFocus = document.querySelector(".close-focus");
        closeFocus.click();
      } else {
        let closeFocus = document.querySelector(".close-focus");
        closeFocus.click();
        openAside(postId, closestHeart, post)
      } 
    });   
  });

  comments.forEach((comm) => {
    comm.addEventListener("click", () => {
      let article = comm.closest("article");
        let postId = article.id;
        if(!commentOpen) {
          openComment(postId);
        } else if(numComment==postId) {
          let closeFocus = document.querySelector(".close-comment");
          closeFocus.click();
        } else if(commentOpen) {
          let closeFocus = document.querySelector(".close-comment");
          closeFocus.click();
          openComment(postId);
        }
    });
  });

  const urlParams = new URLSearchParams(window.location.search);
  const myParam = urlParams.get('post');
  comments.forEach((comm) => {
    let article = comm.closest("article");
    let postId = article.id;
    if(postId == myParam) {
      openComment(postId);
    }
  })
}

function followProcedure(follow){
  let str = follow.id;
  let target;
  if (str !== "") {
    let parts = str.split(" - ");
    target = parts[1];
  }
  let req = new XMLHttpRequest()
  if(follow.classList.contains("fa-user-plus")){
      req.onload = function() {
          if(req.responseText === "true"){
              follow.classList.remove("fa-user-plus")
              follow.classList.add("fa-user-check")
          }
      }
      req.open("GET", "process_follow.php?target=" + target)
      req.send()
  }else{
      req.onload = function() {
          if(req.responseText === "true"){
            console.log("yehaw")
              follow.classList.remove("fa-user-check")
              follow.classList.add("fa-user-plus")
          }
      }
      req.open("GET", "process_unfollow.php?target=" + target)
      req.send()
  }
}

//Down here it deals with the post, the aside and the like functionality
function openAside(postId, closestHeart, post) {
  asideOpen = true;
    var xhttp;    
    xhttp = new XMLHttpRequest();
    xhttp.open("GET", "template/post_focus.php?post="+postId, true);
    xhttp.onreadystatechange = function() {
      if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
          // Add requested previews to section
          showPopover(this.responseText, Popover.Aside, null);
          numAside = postId;
          let focusHeartIcon = document.querySelector(".fa-heart.focus");
          addCloseListener(closestHeart,focusHeartIcon);
          heartPairs.set(closestHeart,focusHeartIcon);
          heartPairs.set(focusHeartIcon,closestHeart);
          focusHeartIcon.addEventListener('click', (event) => toggleColor(event,post));
          let follow = document.querySelector(".follow");
          follow.addEventListener("click", ()=>followProcedure(follow));
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

      let article = post.closest("article");
      let postId = article.id;
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
//This code deals with the opening of the comment. It send the request XHTML request
function openComment(postId) {
        commentOpen=true;
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.open("GET", "template/comments.php?post="+postId, true);
        xhttp.onreadystatechange = function() {
          if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
              // Add requested previews to section
              let below = getSectionAbove(postId);
              showPopover(this.responseText, Popover.Footer, below);
              numComment = postId;
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
      let article = comments[i].closest("article");
      let postId = article.id;
      if(queryPostID === postId) {
          return comments[i].closest('section');
      }
    }
}
