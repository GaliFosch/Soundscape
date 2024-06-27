let posts = null;
let comments = null;
let postComment = null;
let commentOpen = false;
let numComment = null;
let shownCount = 0;

window.onload = () => {
  posts = document.querySelectorAll(".open-focus");
  comments = document.querySelectorAll(".fa-message");
  

  posts.forEach((post) => {
    let article = post.closest("article");
    post.addEventListener("click", () => {
      let postId = article.id;
      var newUrl = 'single_post.php?id=' + postId;
      window.location.href = newUrl;
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


//This code deals with the popovers, both aside and footer
function showPopover(content, ver, below) {
  let popover;:
  popover = document.createElement('footer');
  popover.classList.add('popover-comment');
  break;
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

window.addEventListener("scroll", () =>{
  const endOfPage = window.innerHeight + window.scrollY >= document.body.scrollHeight-1;
  console.log(endOfPage)
  if (endOfPage) {
    onShowMore()
  }
});

function onShowMore() {
  let toShowCount = 10;
  const request = new XMLHttpRequest()
    request.open(
        "GET",
        "process_feed.php?show=" + toShowCount + "&skip=" + shownCount,
        true
    );
    request.onreadystatechange = function() {
        if ((this.readyState === 4) && (this.status === 200)) {
          let section = document.createElement("section");
          section.classList.add = "feed";
          section.innerHTML = this.responseText;
          let main = document.querySelector("main");
          main.appendChild(section);
        }
    }
    request.send();
    shownCount += toShowCount;
}


