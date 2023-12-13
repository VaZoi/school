let slides = document.querySelectorAll(".slide");
let dots = document.querySelectorAll(".dot");
let maxSlide = slides.length - 1;
let curSlide = 0;

slides.forEach((slide, indx) => {
    slide.style.transform = `translateX(${indx * 100}%)`;
});

dots.forEach((dot, indx) => {
    dot.addEventListener("click", () => {
        curSlide = indx;
        updateSlider();
    });
});

function updateSlider() {
    slides.forEach((slide, indx) => {
        slide.style.transform = `translateX(${(100 * (indx - curSlide))}%)`;
    });

    dots.forEach((dot, indx) => {
        if (indx === curSlide) {
            dot.classList.add("active");
        } else {
            dot.classList.remove("active");
        }
    });
}

let nextSlide = document.querySelector("#btn-next");
nextSlide.addEventListener("click", function () {
    if (curSlide == maxSlide) {
        curSlide = 0;
    } else {
        curSlide++;
    }
    updateSlider();
});

const prevSlide = document.querySelector("#btn-prev");
prevSlide.addEventListener("click", function () {
    if (curSlide === 0) {
        curSlide = maxSlide;
    } else {
        curSlide--;
    }
    updateSlider();
});
