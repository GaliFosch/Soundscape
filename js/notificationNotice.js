const signal = Array.from(document.getElementsByClassName("notifSignal"));

const displayArray = new Array();
signal.forEach((el)=>displayArray.push(el.style.display));

let displayed = false;
hide();

function pollNotification(){
    fetch('process_notif_check.php')
        .then(response => response.text())
        .then(data =>{
            if(data === "1"){
                show();
                displayed = true;
            }
        })
        .finally(()=>{
            if(!displayed){
                setTimeout(pollNotification, 5000);
            }
        })
}

function show(){
    signal.forEach((el)=>el.classList.remove("hide"));
}

function hide(){
    signal.forEach((el)=>el.classList.add("hide"));
}

let path = window.location.pathname;
let page = path.split("/").pop();
if(page !== "notifications.php"){
    pollNotification();
}