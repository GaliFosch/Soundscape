/*This part deals with the navbar*/
const hamburgerMenu = document.querySelector("#open-menu-icon");
const closeHamburgerMenu = document.querySelector("#close-menu-icon");
const mobileMenu = document.querySelector(".mobile-menu");
const navbar = document.querySelector(".navbar");

const notifSignal = document.getElementById("menuNotifSignal");
let notifSignalDisplay = null;
if (notifSignal != null) {
  notifSignalDisplay = notifSignal.style.display;
}


hamburgerMenu.addEventListener("click", () => {
  let mobileMenuStyle = window.getComputedStyle(mobileMenu);
  if (mobileMenuStyle.display === "none") {
    mobileMenu.style.display = "block";
    navbar.className = "mobile-full"
    hamburgerMenu.style.display = "none";
    closeHamburgerMenu.style.display = "flex";
    if (notifSignal != null) {
      notifSignal.style.display = "none";
    }
  }
});

closeHamburgerMenu.addEventListener("click", () => {
  let mobileMenuStyle = window.getComputedStyle(mobileMenu);
  if (mobileMenuStyle.display === "block") {
    mobileMenu.style.display = "none";
    navbar.className = "mobile"

    hamburgerMenu.style.display = "flex";
    closeHamburgerMenu.style.display = "none";
    if (notifSignal != null) {
      notifSignal.style.display=notifSignalDisplay;
    }
  } 
});

onresize = () => {
  let width = window.innerWidth;
  if(width>768){
    navbar.className = "desktop"
    hamburgerMenu.style.display = "none";
    closeHamburgerMenu.style.display = "none";
    mobileMenu.style.display = "block";
    if (notifSignal != null) {
      notifSignal.style.display = "none";
    }
  }
  if(width<768){
    navbar.className = "mobile";
    hamburgerMenu.style.display = "flex";
    closeHamburgerMenu.style.display = "none";
    mobileMenu.style.display = "none";
    if (notifSignal != null) {
      notifSignal.style.display=notifSignalDisplay;
    }
  }
};
