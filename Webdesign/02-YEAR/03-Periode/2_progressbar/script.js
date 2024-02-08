const circle = document.querySelector(".circle");
const value = document.getElementById("value");

const circlephp = document.querySelector(".circlephp");
const valuephp = document.getElementById("valuephp");

const circlehtmlcss = document.querySelector(".circlehtmlcss");
const valuehtmlcss = document.getElementById("valuehtmlcss");

const circleCsharp = document.querySelector(".circleCsharp");
const valueCsharp = document.getElementById("valueCsharp");

function Progress(circle, value, end) {
    let counter = 0;
    let speed = 50;

    let progress = setInterval(() => {
        counter++;
        value.innerHTML = counter + '%';
        circle.style.background = `conic-gradient(rgb(17, 255, 8) ${counter * 3.6}deg, rgb(0, 0, 0, 0.1) 0deg)`;

        if (counter === end) {
            clearInterval(progress);
        }
    }, speed);
}
Progress(circle, value, 50);
Progress(circlephp, valuephp, 25);
Progress(circlehtmlcss, valuehtmlcss, 75);
Progress(circleCsharp, valueCsharp, 10);
