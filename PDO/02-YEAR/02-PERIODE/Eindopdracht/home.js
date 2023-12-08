

var modal = document.getElementById('id01');

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function checkLogin() {
    if (!confirm("You need to be logged in to access this page. Do you want to login?")) {
        return false;
    }
    window.location.href = "login.php";
    return false;
}
