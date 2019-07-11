window.onload = function() {
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
    }
   
   
}