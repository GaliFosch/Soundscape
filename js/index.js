let posts = null;
let comments = null;
let postComment = null;
let commentOpen = false;
let numComment = null;
let shownCount = 0;

function likeProcedure() {
  let hearts= document.querySelectorAll(".fa-heart");

  hearts.forEach((heart)=>{
    heart.addEventListener(("click"), ()=> {  
      let article = heart.closest("article");
      let postId = article.id;
      let xhttp;    
      xhttp = new XMLHttpRequest();
      xhttp.open("GET", "template/like_handler.php?post="+postId, true);
      xhttp.onreadystatechange = function() {
        if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {

            if(this.responseText==="change") {
              heart.classList.toggle('fa-solid');
              heart.classList.toggle('fa-regular');
            }
        }
      }
      xhttp.send();
    });
  });
}

function commentProcedure() {
  comments = document.querySelectorAll(".fa-message");


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
}

function postProcedure() {
  posts = document.querySelectorAll(".open-focus");
  posts.forEach((post) => {
    let article = post.closest("article");
    post.addEventListener("click", () => {
      let postId = article.id;
      var newUrl = 'single_post.php?id=' + postId;
      window.location.href = newUrl;
    });   
  });

}

function followProcedure(){
  let follows =  document.querySelectorAll('[id^="follow -"]');

  follows.forEach((follow) => {
    follow.addEventListener("click", ()=> {
      let str = follow.id;
      let target;
      if (str !== "") {
        let parts = str.split(" - ");
        target = parts[1];

      }
      let em = follow.querySelector("#follow");
      let req = new XMLHttpRequest()
      if(em.classList.contains("fa-user-plus")){
          req.onload = function() {
              if(req.responseText === "true"){
                  em.classList.remove("fa-user-plus")
                  em.classList.add("fa-user-check")
              }
          }
          req.open("GET", "process_follow.php?target=" + target)
          req.send()
      }else{
          req.onload = function() {
              if(req.responseText === "true"){
                  em.classList.remove("fa-user-check")
                  em.classList.add("fa-user-plus")
              }
          }
          req.open("GET", "process_unfollow.php?target=" + target)
          req.send()
      }
    })
  });
}

//This code deals with footer
function showPopover(content, below) {
  let popover;
  popover = document.createElement('footer');
  popover.classList.add('popover-comment');
  popover.classList.add('popover');
  popover.innerHTML = content;
  below.insertAdjacentElement('afterend', popover);
};

//This code deals with the close function both of the aside and the footer
function addCloseListener() {
  let commentFocus = document.querySelector(".popover-comment");
  let closeComment = document.querySelector(".close-comment");

  if(commentFocus!=null) {
    closeComment.addEventListener("click", () => {
        commentFocus.remove();
        commentOpen = false;
        document.querySelector('body').style.overflow = "scroll";
    });
  }
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
    followProcedure();
  })
};

//Down here it deals with the comment section
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
              showPopover(this.responseText, below);
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

window.onload = () => {
  postProcedure();
  commentProcedure();
  likeProcedure();
}


