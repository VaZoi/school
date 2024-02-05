const map = new Map();

map.set('naam', 'Josef');
map.set('leeftijd', 17);

resultaat = map.has('naam');

const naam = map.get('naam');
const leeftijd = map.get('leeftijd');

map.delete('leeftijd');
map.clear();

const aantal_items = map.size;

const contacten = new Map();
contacten.set('Josef', {
    telefoon: '0612345678',
    opleiding: 'Software develoepr'
});

contacten.set('Marion', {
    telefoon: '0687654321',
    opleiding: 'Webdesign'
});

const contact = contacten.get('Josef');
const opleiding = contact.opleiding;

for (var [key, value] of contacten.entries()) {
    console.log(key + " = " + value.telefoon);
}

contacten.forEach(function (key, val) {
    console.log(val + " = " + key.telefoon);
})