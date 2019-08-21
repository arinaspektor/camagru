let container = null;
let mask_container = null;
let video = null;

let mouseOffset = {x: 0, y: 0};
let isMouseDown = false;
let scale = 1;



function addLike(obj) {

    let src = obj.src;
    let replace = 'liked';
    let new_src = 'unliked';
    let like = false;

    if (src.indexOf('unliked') !== -1) {
        replace = 'unliked';
        new_src = 'liked';
        like = true;
    }

    let formData = new FormData();

    formData.append('like', like);
    formData.append('post_id', obj.closest('.post').id);

    let xhr = new XMLHttpRequest();
       
    xhr.open("POST", "like", true);
    xhr.send(formData);

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           try {
                obj.src = src.replace(replace, new_src);
                obj.nextElementSibling.innerText = this.response;
            } catch(e) {
                alert('Something went wrong. Please, try again!');
            }
        }
     };

}


function addComment(e, form) {
    e.preventDefault();

    let text = form.querySelector('textarea').value;
    form.querySelector('textarea').value = '';

    if (text == '') {
        alert('Please, add some text first!');
    } else if (text.length > 200) {
        alert('Max length of comment is 200 characters!');
    } else {
        let formData = new FormData();

        formData.append('text', text);
        formData.append('post_id', form.closest('.post').id);

        let xhr = new XMLHttpRequest();
       
        xhr.open("POST", "comment", true);
        xhr.send(formData);
    
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                try {
                    let decoded = JSON.parse(this.response);

                    if (decoded.error == "false") {
                        let comment = document.createElement('p');
                        let author = document.createElement('span');
                        let toappend = form.closest('.post').querySelector('.comments');
    
                        author.innerText = decoded.author;
                        comment.innerText =  decoded.comment;
    
                        comment.insertBefore(author, comment.childNodes[0]);
                        toappend.appendChild(comment);
                    }
                } catch(e) {
                    alert('Something went wrong. Please, try again!');
                }
            }
         };
    }
}



function deletePost() {
  
    let formData = new FormData();
    let post = document.querySelector('.post');
    let img = post.querySelector('img');

    formData.append('post_id', post.id);
    formData.append('src', img.src);

    let xhr = new XMLHttpRequest();

    xhr.open("POST", "delete", true);
    xhr.send(formData);
    
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != 'error') {
                let list = document.querySelector('.photos').childNodes;

                for (let i=0; i < list.length; i++) {
                    if (list[i].src == img.src) {
                        list[i].remove();
                        break ;
                    }
                }

                img.src = null;
                post.parentElement.style.display = 'none';
                document.querySelector('.snap_container').style.display = 'flex';
            }
        }
     };


}


function showInfo(data) {
    let likeimg = document.querySelector('.likes img');
    let src = likeimg.src;

    if (data.liked && src.includes('unliked')) {
        src = src.replace('unliked', 'liked');
    } else if (! data.liked && ! src.includes('unliked')) {
        src = src.replace('liked', 'unliked');
    }

    likeimg.src = src;
    document.querySelector('.likes p').innerText = data.likes;

    let div = document.querySelector('.comments');

    if (div.hasChildNodes) {
        let child = div.lastElementChild;  

        while (child) { 
            div.removeChild(child); 
            child = div.lastElementChild; 
        } 
    }

    if (data.comments) {
        let comments = data.comments;

        for (let i = 0; i < comments.length; i++) {
            let p = document.createElement('p');
            p.innerHTML = '<span>'+comments[i].author+'</span>'+comments[i].text;
            div.appendChild(p);
        }

    }
    
}



function getInfo(id) {
    let xhr = new XMLHttpRequest();

    xhr.open("GET", "view/"+id, true);
    xhr.send();

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                let decoded = JSON.parse(this.response);
                showInfo(decoded);
            } catch (e) {
                return false;
            }
        }
    }

}


function viewPost(item, id) {
    let post = document.querySelector('.post-container');
    let tohide = document.querySelector('.snap_container');
    let h = tohide.offsetHeight ? tohide.offsetHeight : post.offsetHeight;
    let img = document.querySelector('.post > img');

    img.src = item.src;

    img.onload = function() {
        post.querySelector('.post').id = id;
        getInfo(id);

        tohide.style.display = 'none';
        post.style.display = 'flex';
        post.style.height = h + 'px';
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

    if (item.offsetHeight * scale < mask_container.offsetHeight && item.offsetWidth * scale < mask_container.offsetWidth ) {
        isMouseDown = true;
        mouseOffset = { x: item.offsetLeft - e.clientX, y: item.offsetTop - e.clientY };
    }
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


function changeMode(btn = null) {
    let img_container = container.querySelector('.img-container');
    let mask = container.querySelector('.mask');

    if (img_container.style.display == 'flex') {img_container.style.display = "none";}

    if (mask) { mask.remove(); }

    uploaded = 0;
    video.style.display = 'block';

    if (btn) {btn.style.display = 'none'; }
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
