
let remove = document.querySelector('.remove');
let fileInput = document.getElementById('images');
let files ;
 
if(remove!=null) {
    remove.addEventListener("click", ()=> {
        let url = window.location.href;

        // Parse the URL
        let urlParts = url.split('?');
        let query = urlParts[1];

        // Check if the query string contains 'track'
        if (query.includes('track')) {
        // Update the URL
        window.location.href = urlParts[0];
        }  
    });  
}

function checkFileFormat(fileList) {
    for (let i = 0; i < fileList.length; i++) {
        if (fileList[i].type.includes("image")) {
            return true;
        } else {
            alert("Invalid image.\nThe format of this file is not accepted.\nAccepting jpg/png.");
            return false;
        }
    }
    return false;
}

fileInput.addEventListener('change', (event) => {
  files = event.target.files;
  console.log(files);
  let fileList = Array.from(files);
  console.log(fileList);
    if(!checkFileFormat(fileList)) {
        const dataTransfer = new DataTransfer();
        fileInput.files = dataTransfer.files;
    } else {
        if (files.length > 10) {
    alert('You can only select up to 10 files');
    event.target.value = '';
  } else {

    let section = document.createElement('section');
    section.classList.add("selected-image-viewer");  
    let main = document.querySelector('main');
    
    fileList.forEach((element ,index) => {   
        let inner = document.createElement('section');
        let img = document.createElement('img');
        let em = document.createElement('em');

        inner.classList.add("inner-image-viewer");
        img.classList.add("selected-image");
        em.classList.add("fa-solid");
        em.classList.add("fa-xmark");
        img.src = URL.createObjectURL(element);

        inner.appendChild(img);
        inner.appendChild(em);
        section.appendChild(inner);

        em.addEventListener("click", () => {
            fileList.splice(index, 1);
            const newFileList = [];
            const dataTransfer = new DataTransfer();
            fileList.forEach(file => {
                dataTransfer.items.add(file);
                newFileList.push(file);
            });
            fileInput.files = dataTransfer.files;
            img.remove();
            em.remove();
            inner.remove();
            if(newFileList.length === 0) {
                section.remove()
            }
            fileList = newFileList;
        })
    });
    main.appendChild(section);

  }
    }
  
  
});

document.onload = ()=> {
    if(document.getElementById("post-msg")!=null) {
        let msgSection = document.querySelector(".msg-section");
        let time = document.createElement('p');
        time.innerText = "Redirecting in 5..."
        delay();
        window.location.href = "https://newurl.com";
    } 
}

async function delay() {
    await new Promise(resolve => setTimeout(resolve, 5000));
}