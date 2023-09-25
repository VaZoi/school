function theme() {
    let toggle = document.getElementById("toggle");
    if (toggle.checked == true) {
        document.getElementById("body").style.color = "white";
        document.getElementById('body').style.backgroundColor = "black"
    } else {
        document.getElementById("body").style.color = "black";
        document.getElementById("body").style.backgroundColor = "white";
    }
}