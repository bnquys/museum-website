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

