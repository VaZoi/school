let contacten = [];
contacten.push({
    "naam": "Dylan Huisden",
    "telefoon": "0612345678"
});

contacten.push({
    "naam": "Nitin Bosman",
    "telefoon": "061234533"
});

contacten.push({
    "naam": "Joseph Demirel",
    "telefoon": "0632145678"
});

contacten.push({
    "naam": "Akash Kabli",
    "telefoon": "0662345666"
});

function zoekContacten(zoektekst) {
    zoektekst = zoektekst.toUpperCase();
    let myGrid = "<div class='cell'><b>Naam</b></div><div class='cell'><b>Telefoon</b></div>";

    for (let x = 0; x < contacten.length; x++) {
        if (contacten[x].naam.toUpperCase().includes(zoektekst)) {
            myGrid += `<div class="cell">${contacten[x].naam}</div>`;
            myGrid += `<div class="cell">${contacten[x].telefoon}</div>`;
        }
    }

    document.getElementById('grid').innerHTML = myGrid;
}
