let projecten = [];
projecten.push({
    "project": "Duurzame landbouw",
    "land": "Bangladesh"
});

projecten.push({
    "project": "Red de regenwouden",
    "land": "Benin Republiek"
});

projecten.push({
    "project": "Red de regenwouden",
    "land": "Mali"
});

projecten.push({
    "project": "Voedselbossen",
    "land": "Colombia"
});

projecten.push({
    "project": "Voedselbossen",
    "land": "Mali"
});

function zoekprojecten(zoektekst) {
    zoektekst = zoektekst.toUpperCase();
    let myGrid = "<div class='cell'><b>Project</b></div><div class='cell'><b>Land</b></div>";

    for (let x = 0; x < projecten.length; x++) {
        if (projecten[x].project.toUpperCase().includes(zoektekst) || projecten[x].land.toUpperCase().includes(zoektekst)) {
            myGrid += `<div class="cell">${projecten[x].project}</div>`;
            myGrid += `<div class="cell">${projecten[x].land}</div>`;
        }
    }

    document.getElementById('zoekfunctie').innerHTML = myGrid;
}
