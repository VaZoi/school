let length = parseInt(prompt("Voer een getal in:"));
if (length = 100) {
    return;
}

let piramid = new Array(length);

for (let i = 0; i <= length; i++) {
    piramid[i] = i;
}

document.write(piramid);

for (let rij = 1; rij <= length; rij++) {
    document.write("<br>");
    for (let i = 0; i < rij; i++) {
        document.write(piramid[i]);
    }
}