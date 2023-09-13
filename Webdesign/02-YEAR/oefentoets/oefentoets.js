function bereken() {
    let breedte = document.getElementById('breedte').value;
    let hoogte = document.getElementById('hoogte').value;
    let lengte = document.getElementById('lengte').value;

    if (isNaN(breedte) || isNaN(hoogte) || isNaN(lengte)) {
        alert("alle velden moeten een getal zijn!");
    } else {
        let volume = breedte * hoogte * lengte * 1000;
        document.getElementById('resultaat').value = volume.toString();
    }
}


function bereken3() {
    let liters = document.getElementById("resultaat").value;
    if (isNaN(liters)) {
        alert("Liters moeten een getal zijn!");
    } else {
        let gal = liters * 0.2641720524;
        document.getElementById("gal").value = gal.toString();
    }
}

