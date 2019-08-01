
var mouseOffset = {x: 0, y: 0};
var isMouseDown = false;

function openForm() {
    document.querySelector(".layer").style.display = "block";
    document.querySelector(".upload_photo").style.display = "flex";
}

 function closeForm() {
    document.querySelector(".layer").style.display = "none";
    document.querySelector(".upload_photo").style.display = "none";
}



function onMouseDown(e, item) {
    e.preventDefault();
    
    isMouseDown = true;
    mouseOffset = { x: item.offsetLeft - e.clientX, y: item.offsetTop - e.clientY };
}

function onMouseUp(e, item) {
    isMouseDown = false;
}

function onMouseMove(e, item) {
    if (isMouseDown) {
        item.style.left = e.clientX + mouseOffset.x + 'px';
        item.style.top = e.clientY + mouseOffset.y + 'px';
    }
}



function addEvents(mask) {
    mask.addEventListener('mousedown', (e) => {onMouseDown(e, mask);});
    mask.addEventListener('mousemove', (e) => {onMouseMove(e, mask);});
    mask.addEventListener('mouseup', (e) => {onMouseUp(e, mask);});
    mask.addEventListener('dblclick', function() {
        this.remove();
    });
    
    let scale = 1;
    mask.addEventListener('wheel', function(e) {
        let delta = e.deltaY;

        scale += ((delta > 0) ? 0.1 : -0.1);
        this.style.transform = this.style.WebkitTransform = this.style.MsTransform = 'scale(' + scale + ')';

        e.preventDefault();
    });
}


function createMask(item)
{
    let container =  document.querySelector('.camera_wrapper');
    let prev = container.querySelector('.mask');

    if (prev) {
        prev.remove();
    }

    let mask = document.createElement('img');

    mask.classList.add('mask');
    mask.src = item.src;
 
    container.appendChild(mask);

    addEvents(mask);
}


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
}
