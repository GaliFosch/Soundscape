var hamburgerMenu = document.querySelector(".fa-bars");
var closeHamburgerMenu = document.querySelector(".fa-xmark");
var mobileMenu = document.querySelector(".mobile-menu");
var navbar = document.querySelector(".navbar");

hamburgerMenu.addEventListener("click", () => {
  var mobileMenuStyle = window.getComputedStyle(mobileMenu);
  if (mobileMenuStyle.display === "none") {
    mobileMenu.style.display = "block";
    navbar.className = "mobile-full"
    hamburgerMenu.style.display = "none";
    closeHamburgerMenu.style.display = "flex";
  }

});

closeHamburgerMenu.addEventListener("click", () => {
  var mobileMenuStyle = window.getComputedStyle(mobileMenu);
  if (mobileMenuStyle.display === "block") {
    mobileMenu.style.display = "none";
    navbar.className = "mobile"

    hamburgerMenu.style.display = "flex";
    closeHamburgerMenu.style.display = "none";
  } 
});

onresize = () => {
  var width = window.innerWidth;
  if(width>768){
    navbar.className = "desktop"
    hamburgerMenu.style.display = "none";
    closeHamburgerMenu.style.display = "none";
    mobileMenu.style.display = "block";
  }
  if(width<768){
    navbar.className = "mobile";
    hamburgerMenu.style.display = "flex";
    closeHamburgerMenu.style.display = "none";
    mobileMenu.style.display = "none";
  }
};
