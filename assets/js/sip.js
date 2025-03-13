window.addEventListener("scroll", function () {
    const header = document.querySelector(".header");
    if (window.scrollY > 50) {
        // Change the value as needed
        header.classList.add("scrolled");
        header.classList.add("p-3");
    } else {
        header.classList.remove("scrolled");
        header.classList.remove("p-3");
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const hiddenElements = document.querySelectorAll(".mv-rl");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show-rl");
                } else {
                    entry.target.classList.remove("show-rl"); // Remove when scrolled out
                }
            });
        },
        { threshold: 0.2 } // Adjust how much needs to be visible
    );

    hiddenElements.forEach((el) => observer.observe(el));
});

document.addEventListener("DOMContentLoaded", function () {
    const hiddenElements = document.querySelectorAll(".mv-lr");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show-lr");
                } else {
                    entry.target.classList.remove("show-lr"); // Remove when scrolled out
                }
            });
        },
        { threshold: 0.2 } // Adjust how much needs to be visible
    );

    hiddenElements.forEach((el) => observer.observe(el));
});

document.addEventListener("DOMContentLoaded", function () {
    const hiddenElements = document.querySelectorAll(".mv-bt");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show-bt");
                } else {
                    entry.target.classList.remove("show-bt"); // Remove when scrolled out
                }
            });
        },
        { threshold: 0.2 } // Adjust how much needs to be visible
    );

    hiddenElements.forEach((el) => observer.observe(el));
});
