let container = null;
let mask_container = null;
let video = null;

let mouseOffset = {x: 0, y: 0};
let isMouseDown = false;
let scale = 1;



function viewPost(item) {
    let post = document.querySelector('.post');

    let tohide = document.querySelector('.snap_container');

    // post.style.display = 'flex';
    
    let img = document.querySelector('.post > img');
    img.src = item.src;

    img.onload = function() {
        tohide.style.display = 'none';
        post.style.display = 'flex';
        post.style.flex = 'none';
        post.width = img.width + 'px';
    }

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
        let x = e.clientX + mouseOffset.x;
        let y = e.clientY + mouseOffset.y;
        
        let minX = (item.width * scale - item.offsetWidth) / 2;
        let minY = (item.height * scale - item.offsetHeight) / 2;
        let maxX = mask_container.offsetWidth + minX - item.width * scale;
        let maxY = mask_container.offsetHeight + minY - item.height * scale;

        x = x < minX ? minX : (x > maxX ? maxX : x);
        y = y < minY ? minY : (y > maxY ? maxY : y);
        
        item.style.left = x + 'px';
        item.style.top = y + 'px';
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
    mask_container = uploaded ? document.querySelector('.img-container') : container;

    if (prev) {
        prev.remove();
        scale = 1;
    }

    let mask = document.createElement('img');

    mask.classList.add('mask');
    mask.src = item.src;

    mask_container.appendChild(mask);

    addEvents(mask);
}


function changeMode(btn) {
    let img = container.querySelector('.uploaded');
    let mask = container.querySelector('.mask');

    if (img.style.display == 'block') {img.style.display = "none";}

    if (mask) { mask.remove(); }

    uploaded = 0;
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
        container = document.querySelector('.camera_wrapper');
        video =  container.querySelector('#video');

        turnOnWeb();
    }

}
