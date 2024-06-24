const signal = document.getElementById("notifSignal");

function pollNotification(){
    fetch('process_notif_check.php')
        .then(response => response.text())
        .then(data =>{
            if(data === "1"){
                signal.classList.add("show");
            }else{
                signal.classList.remove("show");
            }
        })
        .finally(()=>{
            setTimeout(pollNotification, 5000);
        })
}

let path = window.location.pathname;
let page = path.split("/").pop();
if(page !== "notifications.php"){
    pollNotification();
}