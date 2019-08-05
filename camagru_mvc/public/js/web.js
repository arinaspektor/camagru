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

    canvas.getContext('2d').drawImage(source, 0, 0, source.width, source.height);

    let picture = new Image();
    picture.src = canvas.toDataURL('image/png');

    let container = document.querySelector('.photos');
    container.insertBefore(picture, container.childNodes[0]);

    savePhoto(picture.src, mask);
}


function savePhoto(picture, mask) {

    let formData = new FormData();
    let maskData = {name: mask.src,
                    height: mask.offsetHeight, width: mask.offsetWidth,
                    x: mask.style.left, y: mask.style.top };

    formData.append('photo', picture);
    formData.append('mask', maskData);

    console.log(maskData);

    // let xhr = new XMLHttpRequest();
    //
    // xhr.open("POST", "post", true);
    // xhr.send(formData);
    //
    // xhr.onreadystatechange = function() {
    //     if (this.readyState == 4 && this.status == 200) {
    //     }
    //  };
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
