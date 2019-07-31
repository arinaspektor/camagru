
window.onload = function() {
    var video =  document.querySelector('#video');

    var alertMsg = document.querySelector('.alert');

    if (alertMsg) {
        setTimeout(
            function() {
                alertMsg.style.display = 'none';
            },
            3000);
    }

    turnOnWeb();

    // doImgDraggable();
}


function openForm() {
    document.querySelector(".layer").style.display = "block";
    document.querySelector(".upload_photo").style.display = "flex";
}

 function closeForm() {
    document.querySelector(".layer").style.display = "none";
    document.querySelector(".upload_photo").style.display = "none";
}


// function doImgDraggable() {
//     let imagesContainer = document.querySelector('.images');
    
//     let img = imagesContainer.
//     console.log(imagesContainer);
// }