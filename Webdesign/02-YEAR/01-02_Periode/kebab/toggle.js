function theme() {
    let toggle = document.getElementById("toggle");
    if (toggle.checked == true) {
        document.getElementById("body").style.color = "white";
        document.getElementById('body').style.backgroundColor = "green"
    } else {
        document.getElementById("body").style.color = "green";
        document.getElementById("body").style.backgroundColor = "white";
    }
}