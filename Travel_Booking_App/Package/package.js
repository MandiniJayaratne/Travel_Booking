document.addEventListener("DOMContentLoaded", function () {
    const containers = document.querySelectorAll(".small-container");

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    containers.forEach(container => {
        observer.observe(container);
    });
});
