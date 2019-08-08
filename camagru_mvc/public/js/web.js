const validFileExtensions = /(\.jpg|\.jpeg|\.png)$/i;
const maxSize = 5242880;
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
        navigator.getUserMedia = navigator.getUserMedia
                                || navigator.webkitGetUserMedia
                                || navigator.mozGetUserMedia;

        if (navigator.getUserMedia) {
            navigator.getUserMedia({audio: false, video: true}, handleVideo, videoError);
        }

    }
}


function takePhoto() {
    let mask = document.querySelector('.mask');

    if (! mask) { alert("Choose the mask first!"); return; }

    let canvas = document.createElement('canvas');

    let source = (video.style.display != 'none') ? video :
                      document.querySelector('.uploaded');

    source.width = canvas.width = source.offsetWidth;
    source.height = canvas.height = source.offsetHeight;

    canvas.getContext('2d').drawImage(source, 0, 0, source.width, source.height);;

    let picture = new Image();
    picture.src = canvas.toDataURL('image/png');

    savePhoto(picture.src, mask, source);
}


function validateFile(e) {
    let file = document.getElementsByName('uploaded')[0];
    let filepath = file.value;

    if (! validFileExtensions.exec(filepath)) {
        alert('Please upload file having extensions .jpeg/.jpg/.png/ only.');
        file.value = '';
    } else if (file.files[0].size > maxSize) {
        alert('File is too big. Max size is 5MB.');
    } else if (file.files && file.files[0]) {
        src = URL.createObjectURL(e.target.files[0]);
    }

}

function uploadPhoto(e) {
    if (src) {
        e.preventDefault();

        let img = container.querySelector('.uploaded');
        img.setAttribute('src', src);

        let mask = container.querySelector('.mask');
        if (mask) { mask.remove(); }

        let btn = document.querySelector('.video-on');

        video.style.display = 'none';
        img.style.display = 'block';
        btn.style.display = 'block';

        closeForm();

    } else {

        alert('Something went wrong. Try again');
        openForm();

    }

}


function showResult(url)
{
    if (url === 'error') {
        alert('Something went wront... Please, try again!');
    } else {
        let photos = document.querySelector('.photos');
        let picture = new Image();
        
        picture.src = url;
        photos.insertBefore(picture, photos.childNodes[0]);
    }
}


function savePhoto(picture, mask, source) {

    let formData = new FormData();
    
    let x = mask.offsetLeft / source.width;
    let y = mask.offsetTop / source.height;

    let data = { file: picture, mask: mask.src, x: x, y: y, scale: scale };

    console.log(data);
    let encoded = JSON.stringify(data);
    formData.append('data', encoded);

    let xhr = new XMLHttpRequest();

    xhr.open("POST", "post", true);
    xhr.send(formData);
    
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           showResult(this.responseText);
        }
     };

     mask.remove();
     scale = 1;
}
