function handleVideo(stream) {
    try {
        video.srcObject = stream;
      } catch (error) {
        video.src = URL.createObjectURL(mediaSource);
      }
}


function videoError(e) {
    alert("Something goes wrong...");
}


function turnOnWeb() {
    var video =  document.querySelector('#video');

    if (video) {
        navigator.getUserMedia =    navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia ||
        navigator.oGetUserMedia;

        if (navigator.getUserMedia) {
            navigator.getUserMedia({video: true}, handleVideo, videoError);
        }
        
    }
}


function takePhoto() {
    var newImg = document.createElement('canvas');
    var container = document.querySelector('.photos');

    newImg.getContext('2d').drawImage(video, 0, 0, newImg.width, newImg.height);
    container.insertBefore(newImg, container.childNodes[0]);

    var picture = newImg.toDataURL('image/png');
    savePhoto(picture);
}


function savePhoto(picture) {

    var formData = new FormData();
    formData.append('photo', picture);
    formData.append('mask', "none yet");

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        }
     };
     xhr.open("POST", "post", true);
     xhr.send(formData);
}
