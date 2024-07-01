const searchParams = new URLSearchParams(window.location.search);
let followBtn = document.getElementById("follow-button")
let followIcon = document.getElementById("follow")
console.log(followBtn);

function followProcedure(){
    console.log("enter");
    let req = new XMLHttpRequest()
    let target = searchParams.get("profile")
    if (followIcon.classList.contains("fa-user-plus")) {
        req.onload = function() {
            if (req.responseText === "true") {
                console.log("follow");
                followBtn.innerHTML = `<em id="follow" class="fa-solid fa-user-check"></em>Following`
                followIcon = document.getElementById("follow")
                addToFollowerCount();
            }
        }
        req.open("GET", "process_follow.php?target=" + target)
        req.send()
    } else {
        req.onload = function() {
            if (req.responseText === "true") {
                console.log("unfollow");
                followBtn.innerHTML = `<em id="follow" class="fa-solid fa-user-plus"></em>Follow`
                followIcon = document.getElementById("follow")
                remFromFollowerCount();
            }
        }
        req.open("GET", "process_unfollow.php?target=" + target)
        req.send()
    }
    console.log("exit");
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

followBtn.addEventListener("click", followProcedure)