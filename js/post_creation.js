
let remove = document.querySelector('.remove');
let fileInput = document.getElementById('images');
let files ;
 
if(remove!=null) {
    remove.addEventListener("click", ()=> {
        var url = window.location.href;

        // Parse the URL
        var urlParts = url.split('?');
        var query = urlParts[1];

        // Check if the query string contains 'track'
        if (query.includes('track')) {
        // Update the URL
        window.location.href = urlParts[0];
        }  
    });  
}

fileInput.addEventListener('change', (event) => {
  files = event.target.files;
  if (files.length > 10) {
    alert('You can only select up to 10 files');
    event.target.value = '';
  } else {

    let section = document.createElement('section');
    section.classList.add = "selected-image-viewer";    
    let main = document.querySelector('main');

    files.forEach((element) => {   
        let inner = document.createElement('section');
        let img = document.createElement('img');
        let em = document.createElement('em');

        inner.classList.add = "inner-image-viewer"
        img.classList.add = "selected-image";
        em.classList.add = "fa-solid fa-xmark";
        img.src = URL.createObjectURL(element);

        inner.appendChild(img);
        inner.appendChild(em);
        section.appendChild(inner);
    });
    main.appendChild(section);

    let deleteImage = section.querySelectorAll(".fa-close");
    deleteImage.forEach((em) => {
        em.addEventListener("click", (event) => {
            let imageToDelete = event.target.closest("img");
        } )
    })

  }
  
});