const validFileExtensions = /(\.jpg|\.jpeg|\.png)$/i;
const maxSize = 5242880;
let src = null;
let uploaded = 0;


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
    video =  document.querySelector('#video');

    if (video) {
        navigator.getUserMedia = navigator.getUserMedia
                                || navigator.webkitGetUserMedia
                                || navigator.mozGetUserMedia;

        if (navigator.getUserMedia) {
            navigator.getUserMedia({audio: false, video: true}, handleVideo, videoError);
        }

    }
}


function showResult(data)
{
    let photos = document.querySelector('.photos');
    let picture = new Image();
        
    picture.src = data.src;

    photos.insertBefore(picture, photos.childNodes[0]);
    picture.addEventListener('click', (e) => {viewPost(picture, data.id);});
}


function savePhoto(picture, mask, source) {

    let formData = new FormData();
    
    let x = mask.offsetLeft / source.offsetWidth;
    let y = mask.offsetTop / source.offsetHeight;

    let data = { file: picture, mask: mask.src, x: x, y: y, scale: scale, upld: uploaded};

    let encoded = JSON.stringify(data);
    formData.append('data', encoded);

    let xhr = new XMLHttpRequest();

    xhr.open("POST", "take", true);
    xhr.send(formData);
    

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            $decoded = JSON.parse(this.response);
            showResult($decoded);
        }
     };

     mask.remove();
     scale = 1;
  
}


function takePhoto() {
    let mask = document.querySelector('.mask');
    
    if (! mask) { alert("Choose the mask first!"); return; }

    let source = uploaded ? document.querySelector('.uploaded') : video;
    let canvas = document.createElement('canvas');
    let picture = new Image();

    canvas.width = source.offsetWidth;
    canvas.height = source.offsetHeight;

    canvas.getContext('2d').drawImage(source, 0, 0, source.offsetWidth,source.offsetHeight);

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

        uploaded = 1;
        let img_container = container.querySelector('.img-container');
        let img = container.querySelector('.uploaded');
        let mask = container.querySelector('.mask');
        let btn = document.querySelector('.video-on');

        img.src = src;
        
        if (mask) { mask.remove(); } 

        img.onload = function() {

            if (img_container.style.display != 'flex') {

                let flex_basis = video.clientHeight;
                container.style.flexBasis = flex_basis + 'px';

                video.style.display = 'none';
                img_container.style.display = 'flex';
                btn.style.display = 'block';
            }
           
            let w = img.naturalWidth;
            let h = img.naturalHeight;
            let cw = container.offsetWidth;
            let ch = container.offsetHeight;

            if ((w > cw && h > ch && w > h) || h > w || (w == h && cw >= ch)) {
                img.style.height = (h > ch ? ch : h) + 'px';
                img.style.width = "auto";
            } else {
                img.style.width = (w > cw ? cw : w) + 'px';
                img.style.height = "auto";
            }

            closeForm();
        }
    } else {

        alert('Something went wrong. Try again');
        openForm();

    }

}



