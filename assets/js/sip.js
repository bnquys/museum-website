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
    const animationClasses = [
        "rl",
        "lr",
        "bt",
        "tb",
        "flip",
        "rotate",
        "scale",
    ];

    animationClasses.forEach((animation) => {
        const elements = document.querySelectorAll(`.mv-${animation}`);
        let lastScrollTop = window.scrollY;

        if (elements.length > 0) {
            const observer = new IntersectionObserver(
                (entries) => {
                    let scrollTop = window.scrollY;

                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add(`show-${animation}`);
                        } else {
                            if (scrollTop < lastScrollTop)
                                entry.target.classList.remove(
                                    `show-${animation}`
                                );
                        }
                    });
                    lastScrollTop = scrollTop;
                },
                { threshold: 0.25 }
            );

            elements.forEach((el) => observer.observe(el));
        }
    });
});
