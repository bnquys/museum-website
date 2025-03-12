window.addEventListener("scroll", function () {
    const header = document.querySelector(".header");
    if (window.scrollY > 50) {
        // Change the value as needed
        header.classList.add("scrolled");
    } else {
        header.classList.remove("scrolled");
    }
});

