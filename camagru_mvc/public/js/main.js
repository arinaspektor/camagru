
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
