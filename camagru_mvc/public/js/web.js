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

function takePhoto() {
  var canvas = document.getElementById('canvas'),
              context = canvas.getContext('2d'),
              videoObj = { "video": true} ,
              errBack = function(error) {
                console.log("Video capture error: ", error.code);
              };

  context.drawImage(video, 0, 0, 640, 480);

  var dataUrl = canvas.toDataURL();

  var xhr = new XMLHttpRequest();

  xhr.open('POST', 'save', true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      // File(s) uploaded.
      console.log("upload");
    } else {
      alert('An error occurred!');
    }
  };

  xhr.send(dataUrl);
}

// function takePhoto() {
//   var canvasBlock = document.getElementById('canvas');
//   canvasBlock.style.display = 'block';
//
//   const context = canvasBlock.getContext('2d');
//   context.drawImage(video, 0, 0, canvas.width, canvas.height);
//
//   video.srcObject.getVideoTracks().forEach((track) => {
//       // track.stop();
//   });
//
//   let picture = canvasBlock.toDataURL();
//
//   fetch('/api/save_image.php', {
//     method : 'post',
//     body   : JSON.stringify({data: picture })
//   })
//   .then((res) => res.json())
//   .then((data) => {
//     if(data.success){
//       // Create the image and give it the CSS style with a random tilt
//       //  and a z-index which gets bigger
//       //  each time that an image is added to the div
//       let newImage = createImage(data.path, "new image", "new image", width, height, "masked");
//       let tilt = -(20 + 60 * Math.random());
//       newImage.style.transform = "rotate("+tilt+"deg)";
//       zIndex++;
//       newImage.style.zIndex    = zIndex;
//       newImages.appendChild(newImage);
//       canvasElement.classList.add('masked');
//     }
//   })
//   .catch((error) => console.log(error))
//
//   const createImage = (src, alt, title, width, height, className) => {
//     let newImg = document.createElement("img");
//
//     if(src !== null)       newImg.setAttribute("src", src);
//     if(alt !== null)       newImg.setAttribute("alt", alt);
//     if(title !== null)     newImg.setAttribute("title", title);
//     if(width !== null)     newImg.setAttribute("width", width);
//     if(height !== null)    newImg.setAttribute("height", height);
//     if(className !== null) newImg.setAttribute("class", className);
//
//     return newImg;
// }
//}
