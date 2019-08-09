let container = null;
let video = null;

let mouseOffset = {x: 0, y: 0};
let isMouseDown = false;
let scale = 1;



function viewPost(item) {
    let post = document.querySelector('.post');

    let tohide = document.querySelector('.snap_container');

    tohide.style.display = 'none';
    post.style.display = 'flex';

    document.querySelector('.post > img').src = item.src;
}

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


function scaleMask(e, item) {
    let delta = e.deltaY;

    scale += ((delta > 0) ? 0.05 : -0.05);
    item.style.transform = item.style.WebkitTransform = item.style.MsTransform = 'scale(' + scale + ')';

    e.preventDefault();
}

function addEvents(mask) {
    mask.addEventListener('mousedown', (e) => {onMouseDown(e, mask);});
    mask.addEventListener('mousemove', (e) => {onMouseMove(e, mask);});
    mask.addEventListener('mouseup', (e) => {onMouseUp(e, mask);});

    mask.addEventListener('wheel', (e) => {scaleMask(e, mask);});

    mask.addEventListener('dblclick', function() {
        this.remove();
    });
}


function createMask(item) {
    let prev = container.querySelector('.mask');

    if (prev) {
        prev.remove();
        scale = 1;
    }

    let mask = document.createElement('img');

    mask.classList.add('mask');
    mask.src = item.src;

    container.appendChild(mask);

    addEvents(mask);
}


function changeMode(btn) {
    let img = container.querySelector('.uploaded');
    let mask = container.querySelector('.mask');

    if (img.style.display == 'block') {img.style.display = "none";}

    if (mask) { mask.remove(); }

    video.style.display = 'block';
    btn.style.display = 'none';
}



window.onload = function() {
    let alertMsg = document.querySelector('.alert');

    if (alertMsg) {
        setTimeout(
            function() {
                alertMsg.style.display = 'none';
            },
            3000);
    }

    if( window.location.pathname.includes('/profile') ) {
        container =  document.querySelector('.camera_wrapper');
        video =  container.querySelector('#video');

        turnOnWeb();
    }

}
