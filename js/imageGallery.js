const selected = "selected";
const galleries = document.getElementsByClassName("imgSection");

function slide(array, index, originalDispl = "block", hide = true){
    if(!array[index].classList.contains(selected)){
        let selectedIndex = getIndexOfSelectedElement(array);
        array[selectedIndex].classList.remove(selected);
        array[index].classList.add(selected);
        if(hide){
            for(let i=0; i<array.length; i++){
                if(i<index-1 || i>index+1){
                    array[i].style.display = "none";
                }else{
                    array[i].style.display = originalDispl;
                }
            }
        }
    }
}

function getIndexOfSelectedElement(array){
    for(let i = 0; i<array.length; i++){
        if(array[i].classList.contains(selected)){
            return i;
        }
    }
}

function isTouchDevice() {
    return 'maxTouchPoints' in navigator && navigator.maxTouchPoints > 0 ||
           'ontouchstart' in window || 
           window.matchMedia("(pointer: coarse)").matches;
}

for(let t = 0; t<galleries.length; t++){
    let container = galleries[t].getElementsByClassName("imgContainer")[0];
    let imgs = Array.from(container.getElementsByTagName("img"));
    let dots = Array.from(galleries[t].getElementsByTagName("footer")[0].getElementsByClassName("dot"));
    if(imgs.length>0){
        imgs[0].classList.add(selected);
        dots[0].classList.add(selected);
        let disp = imgs[0].style.display;

        if(isTouchDevice()){
            let touchStartX = 0;
            let touchEndX = 0;
    
            function handleTouchStart(event) {
                touchStartX = event.changedTouches[0].screenX;
            }
    
            function handleTouchEnd(event) {
                touchEndX = event.changedTouches[0].screenX;
                handleSwipeGesture();
            }
    
            function handleSwipeGesture() {
                let currentIndex = getIndexOfSelectedElement(imgs);
                if (touchEndX < touchStartX) {
                    currentIndex = ( currentIndex < imgs.length - 1) ? currentIndex + 1 : currentIndex;
                }else if (touchEndX > touchStartX) {
                    currentIndex = (currentIndex > 0) ? currentIndex - 1 : currentIndex;
                }
                slide(imgs, currentIndex,disp);
                slide(dots, currentIndex, disp, false);
            }
    
            container.addEventListener("touchstart", handleTouchStart, false);
            container.addEventListener("touchend", handleTouchEnd, false)
        }

        for(let i = 0; i<imgs.length; i++){
            imgs[i].addEventListener("click", ()=>{
                slide(imgs,i,disp);
                slide(dots,i,disp, false)
            });
            if(i>1){
                imgs[i].style.display = "none";
            }
        }
    }
}