let menu = document.querySelector("#menu-btn");
let navbar = document.querySelector(".header .navbar");

menu.onclick = () => {
  menu.classList.toggle("fa-times");
  navbar.classList.toggle("active");
};

window.onscroll = () => {
  menu.classList.remove("fa-times");
  navbar.classList.remove("active");
};

document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll(".home .slide");
  let currentIndex = 0;
  const intervalTime = 3000;
  const nextButton = document.querySelector(".next-slide");

  const showSlide = (index) => {
    slides.forEach((slide, i) => {
      slide.style.display = i === index ? "block" : "none";
    });
  };

  const nextSlide = () => {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
  };

  showSlide(currentIndex);

  const slideInterval = setInterval(nextSlide, intervalTime);

  // Add event listener for the next button
  nextButton.addEventListener("click", () => {
    clearInterval(slideInterval);
    nextSlide();
    setInterval(nextSlide, intervalTime);
  });
});
