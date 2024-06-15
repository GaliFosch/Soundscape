function rem_notification(target){
    let req = new XMLHttpRequest()
    let id = target.id;
    req.onload = function() {
        if(req.responseText === "true"){
            notifList.removeChild(target);
        }
    }
    req.open("GET", "process_rem_notification.php?id=" + id)
    req.send()
}
let notifList = document.getElementById("notification_list");
let notifications = notifList.getElementsByClassName("notification");

for(let notif of notifications){
    let close = notif.getElementsByClassName("close")[0]
    close.addEventListener("click", ()=>rem_notification(notif))
}