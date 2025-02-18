document.addEventListener("DOMContentLoaded", function () {
    const sliderWrapper = document.querySelector(".slider-wrapper");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const slides = document.querySelectorAll(".slide");

    let index = 0;
    const slidesPerView = 3; // Numero di slide visibili contemporaneamente
    const totalSlides = slides.length;

    function updateSlider() {
        const maxIndex = totalSlides - slidesPerView;
        index = Math.max(0, Math.min(index, maxIndex));
        const offset = -index * 310 + "px"; // Spostamento del wrapper
        sliderWrapper.style.transform = `translateX(${offset})`; // 🔹 CORRETTO con backtick
    }

    nextBtn.addEventListener("click", function () {
        if (index < totalSlides - slidesPerView) {
            index++;
            updateSlider();
        }
    });

    prevBtn.addEventListener("click", function () {
        if (index > 0) {
            index--;
            updateSlider();
        }
    });

    // Imposta la posizione iniziale corretta
    updateSlider();
});
