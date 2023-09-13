function conversie() {
    let meters = document.getElementById("meters1").value;
    let feet = meters * 3.28084;
    document.getElementById("feet1").value = feet.toString();
}

function conversie2() {
    let feet = document.getElementById("feet2").value;
    let meters = feet * 0.3048;
    document.getElementById("meters2").value = meters.toString();
}

function conversie3() {
    let celsius = document.getElementById("celsius3").value;
    let fahrenheit = celsius * 1.8;
    document.getElementById("fahrenheit3").value = fahrenheit.toString();
}

function conversie4() {
    let fahrenheit = document.getElementById("fahrenheit4").value;
    let celsius = (fahrenheit - 32) * 0.5556;
    document.getElementById("celsius4").value = celsius.toString();
}