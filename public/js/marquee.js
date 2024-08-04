const marquees = document.querySelectorAll(".marquee");

// If a user hasn't opted in for recuded motion, then we add the animation
if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    addAnimation();
}

function addAnimation() {
    marquees.forEach((marquee) => {
        // add data-animated="true" to every `.marquee` on the page
        marquee.setAttribute("data-animated", true);

        // Make an array from the elements within `.marquee-inner`
        const marqueeInner = marquee.querySelector(".marquee__inner");
        const marqueeContent = Array.from(marqueeInner.children);

        // For each item in the array, clone it
        // add aria-hidden to it
        // add it into the `.marquee-inner`
        // Clone each item in the array 3 times
        for (let i = 0; i < 3; i++) {
            marqueeContent.forEach((item) => {
                const duplicatedItem = item.cloneNode(true);
                duplicatedItem.setAttribute("aria-hidden", true);
                marqueeInner.appendChild(duplicatedItem);
            });
        }
    });
}
