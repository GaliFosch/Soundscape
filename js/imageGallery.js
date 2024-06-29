const selected = "selected";
const galleries = document.getElementsByClassName("imgSection");
const maxwidth = 768;

const isTouchDevice = 'maxTouchPoints' in navigator && navigator.maxTouchPoints > 0 ||
                    'ontouchstart' in window || 
                    window.matchMedia("(pointer: coarse)").matches;

function slide(array, index, originalDispl = "block", hide = true){
    if(index<0 || index>=array.length){
        return;
    }
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

for(let t = 0; t<galleries.length; t++){
    const container = galleries[t].getElementsByClassName("imgContainer")[0];
    const imgs = Array.from(container.getElementsByTagName("img"));
    const dots = Array.from(galleries[t].getElementsByTagName("footer")[0].getElementsByClassName("dot"));
    const previous = container.getElementsByClassName("previous")[0];
    const next = container.getElementsByClassName("next")[0];

    if(imgs.length>0){
        imgs[0].classList.add(selected);
        dots[0].classList.add(selected);
        let disp = imgs[0].style.display;

        if(isTouchDevice){
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


        // this section handles the previous and next buttons
        previous.addEventListener("click", ()=>{
            const index = getIndexOfSelectedElement(imgs)-1;
            slide(imgs,index,disp);
            slide(dots,index,disp, false);
            if(index === 0){
                previous.style.display = "none";
            }
            if(index<imgs.length-1){
                next.style.display = "unset";
            }
        })

        next.addEventListener("click", ()=>{
            const index = getIndexOfSelectedElement(imgs)+1;
            slide(imgs,index,disp);
            slide(dots,index,disp, false);
            if(index === imgs.length-1){
                next.style.display = "none";
            }
            if(index>0){
                previous.style.display = "unset";
            }
        })
        
        previous.style.display = "none";
        if(window.innerWidth<=maxwidth){
            if(isTouchDevice){
                next.style.display = "none";
            }else{
                if(imgs.length<2){
                    next.style.display = "none";
                }
            }
        }else{
            next.style.display = "none";
        }

        window.addEventListener("resize", ()=>{
            if(window.innerWidth<=maxwidth){
                if(isTouchDevice){
                    previous.style.display = "none";
                    next.style.display = "none";
                }else{
                    let index = getIndexOfSelectedElement(imgs)
                    if(index===0){
                        previous.style.display = "none";
                    }else{
                        previous.style.display = "";
                    }
                    if(index===imgs.length-1){
                        next.style.display = "none";
                    }else{
                        next.style.display = "";
                    }
                }
            }else{
                previous.style.display = "none";
                next.style.display = "none";
            }
        })

        for(let i = 0; i<imgs.length; i++){
            imgs[i].addEventListener("click", ()=>{
                slide(imgs,i,disp);
                slide(dots,i,disp, false);
            });
            if(i>1){
                imgs[i].style.display = "none";
            }
        }
    }
}