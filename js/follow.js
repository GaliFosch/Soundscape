const searchParams = new URLSearchParams(window.location.search);

function followProcedure(follow){
    let req = new XMLHttpRequest()
    let target = searchParams.get("profile")
    if(follow.classList.contains("fa-user-plus")){
        req.onload = function() {
            if(req.responseText === "true"){
                follow.classList.remove("fa-user-plus")
                follow.classList.add("fa-user-check")
                addToFollowerCount();
            }
        }
        req.open("GET", "process_follow.php?target=" + target)
        req.send()
    }else{
        req.onload = function() {
            if(req.responseText === "true"){
                follow.classList.remove("fa-user-check")
                follow.classList.add("fa-user-plus")
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

let follow = document.getElementById("follow")

follow.addEventListener("click", ()=>followProcedure(follow))