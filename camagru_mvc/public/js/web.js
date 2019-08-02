const validFileExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
const maxSize = 2097152;
let src = null;

function handleVideo(stream) {
    try {
        video.srcObject = stream;
      } catch (error) {
        video.src = URL.createObjectURL(mediaSource);
      }
}


function videoError(e) {
    alert("Unfortunetly, your browser doesn't support video, you can upload your image.");
}


function turnOnWeb() {
    var video =  document.querySelector('#video');

    if (video) {
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

        if (navigator.getUserMedia) {
            navigator.getUserMedia({audio: false, video: true}, handleVideo, videoError);
        }
        
    }
}


function takePhoto() {
    let newImg = document.createElement('canvas');
    let container = document.querySelector('.photos');
    let img = document.querySelector('.uploaded');

    if (video.style.display != 'none') {
        newImg.getContext('2d').drawImage(video, 0, 0, newImg.width, newImg.height);
    } else {
        newImg.getContext('2d').drawImage(img, 0, 0, newImg.width, newImg.height);
    }
    // newImg.getContext('2d').drawImage(video, 0, 0, newImg.width, newImg.height);
    container.insertBefore(newImg, container.childNodes[0]);

    let picture = newImg.toDataURL('image/png');
    savePhoto(picture);
}


function savePhoto(picture) {

    let formData = new FormData();
    formData.append('photo', picture);
    formData.append('mask', "none yet");

    let xhr = new XMLHttpRequest();

    xhr.open("POST", "post", true);
    xhr.send(formData);

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        }
     };
}


function validateFile(e) {
    let file = document.getElementsByName('uploaded')[0];
    let filepath = file.value;

    if (! validFileExtensions.exec(filepath)) {
        alert('Please upload file having extensions .jpeg/.jpg/.png/ only.');
        file.value = '';
    } else if (file.files[0].size > maxSize) {
        alert('File is too big. Max size is 2MB.');
    } else if (file.files && file.files[0]) {
        src = URL.createObjectURL(e.target.files[0]);
    }

}


function uploadPhoto(e) {
    if (src) {
        e.preventDefault();


        let img = container.querySelector('.uploaded');
        img.src = src;

        let mask = container.querySelector('.mask');
        if (mask) { mask.remove(); }
        
        let btn = document.querySelector('.video-on');
       
        video.style.display = 'none';
        img.style.display = 'block';
        btn.style.display = 'block';

        container.appendChild(img);
        
        closeForm();

    } else {

        alert('Something went wrong. Try again');
        openForm();

    }

}
