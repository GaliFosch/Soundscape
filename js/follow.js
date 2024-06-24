const searchParams = new URLSearchParams(window.location.search);
// let followBtn = document.getElementById("follow-button")
let followIcon = document.getElementById("follow")

function followProcedure(){
    let req = new XMLHttpRequest()
    let target = searchParams.get("profile")
    if (followIcon.classList.contains("fa-user-plus")){
        req.onload = function() {
            // console.log(req.responseText)
            if(req.responseText === "true"){
                followIcon.classList.remove("fa-user-plus")
                followIcon.classList.add("fa-user-check")
                // followBtn.innerText = "Following"
                addToFollowerCount();
            }
        }
        req.open("GET", "process_follow.php?target=" + target)
        req.send()
    } else {
        req.onload = function() {
            if(req.responseText === "true"){
                followIcon.classList.remove("fa-user-check")
                followIcon.classList.add("fa-user-plus")
                // followBtn.innerText = "Follow"
                remFromFollowerCount();
            }
        }
        req.open("GET", "process_unfollow.php?target=" + target)
        req.send()
    }
}

function addToFollowerCount(){
    let followerCount = document.getElementById("followerCount");
    let currentCount = parseInt(followerCount.textContent, 10);
    currentCount += 1;
    followerCount.textContent = currentCount;
}

function remFromFollowerCount(){
    let followerCount = document.getElementById("followerCount");
    let currentCount = parseInt(followerCount.textContent, 10);
    currentCount -= 1;
    followerCount.textContent = currentCount;
}

followIcon.addEventListener("click", ()=> followProcedure())