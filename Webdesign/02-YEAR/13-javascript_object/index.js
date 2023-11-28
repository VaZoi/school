student = {
    id: 1,
    naam: 'Jozef',
    email: 'jozef@live.nl',
    opleiding: 'Software developer'
}

let resultaat = student.hasOwnProperty("naam");

let studenten = [];

studenten.push({
    id: 1,
    naam: 'Jesse',
    email: 'jesse@live.nl',
    opleiding: 'Webdesigner'
})

let resultaat2 = studenten[0].naam;

const laptops = {
    'macbook': {
        'model': 'air',
        'voorraad': 2000,
        'prijs': 1090
    },
    'asusbook': {
        'model': 'air',
        'voorraad': 1000,
        'prijs': 990
    }
};

let resultaat3 = 'macbook' in laptops;

for (const key in laptops) {
    console.log(`${key} -> ${laptops[key].model}`);
}

Object.entries(laptops).forEach(([key, value]) => {
    console.log(`${key} -> ${value.voorraad}`);
});