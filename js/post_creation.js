
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

function removePreviousImages() {
  let section = document.querySelector(".selected-image-viewer");
  if(section!=null) {
    section.remove();
  }
  
}

fileInput.addEventListener('input', (event) => {
    removePreviousImages();
    files = event.target.files;
    let fileList = Array.from(files);
  
    if (!checkFileFormat(fileList)) {
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
  
        let fileInfo = {};
  
        fileList.forEach((element) => {
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

          // Store the file information in the fileInfo object
          fileInfo[element.name] = {
            file: element,
            inner: inner,
            img: img,
            em: em
          };
  
          em.addEventListener("click", () => {
            // Remove the file from the fileInfo object
            delete fileInfo[element.name];
  
            // Update the fileInput and the DOM
            let dataTransfer = new DataTransfer();
            Object.values(fileInfo).forEach(info => {
              dataTransfer.items.add(info.file);
            });
            fileInput.files = dataTransfer.files;
            img.remove();
            em.remove();
            inner.remove();
            if (Object.keys(fileInfo).length === 0) {
              section.remove();
            }
          });
        });
        main.appendChild(section);
      }
    }
  });
