
window.onload = function() {
    var alertMsg = document.querySelector(".alert");

    if (alertMsg) {
    setTimeout(
        function() {
            alertMsg.style.display = 'none';
        },
        3000);
    }
}

function openForm() {
    document.querySelector(".layer").style.display = "block";
    document.querySelector(".upload_photo").style.display = "flex";

}
