// =========================
// SIDEBAR
// =========================

const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");

window.toggleMenu = function () {

    if (sidebar.style.left === "0px") {

        sidebar.style.left = "-320px";

        overlay.classList.add("hidden");

        document.body.style.overflow = "auto";

    } else {

        sidebar.style.left = "0px";

        overlay.classList.remove("hidden");

        document.body.style.overflow = "hidden";

    }

};

// =========================
// SMOOTH REVEAL ANIMATION
// =========================

const revealElements = document.querySelectorAll(
    ".bg-white, .rounded-3xl, .rounded-[30px], .rounded-[35px]"
);

const observer = new IntersectionObserver((entries) => {

    entries.forEach((entry) => {

        if (entry.isIntersecting) {

            entry.target.style.opacity = "1";

            entry.target.style.transform =
                "translateY(0px) scale(1)";

        }

    });

}, {
    threshold: 0.15
});

revealElements.forEach((el, index) => {

    el.style.opacity = "0";

    el.style.transform =
        "translateY(80px) scale(.95)";

    el.style.transition =
        `all .9s cubic-bezier(.17,.84,.44,1) ${index * 0.05}s`;

    observer.observe(el);

});

// =========================
// FLOATING HERO EFFECT
// =========================

const hero = document.querySelector(".bg-gradient-to-r");

let currentX = 0;
let currentY = 0;

let targetX = 0;
let targetY = 0;

document.addEventListener("mousemove", (e) => {

    targetX =
        (window.innerWidth / 2 - e.clientX) / 40;

    targetY =
        (window.innerHeight / 2 - e.clientY) / 40;

});

function animateHero() {

    currentX += (targetX - currentX) * 0.05;

    currentY += (targetY - currentY) * 0.05;

    if (hero) {

        hero.style.transform =
            `translate(${currentX}px, ${currentY}px)`;

    }

    requestAnimationFrame(animateHero);

}

animateHero();

// =========================
// MAGNETIC BUTTON EFFECT
// =========================

const buttons = document.querySelectorAll("button");

buttons.forEach((button) => {

    button.addEventListener("mousemove", (e) => {

        const rect = button.getBoundingClientRect();

        const x =
            e.clientX - rect.left - rect.width / 2;

        const y =
            e.clientY - rect.top - rect.height / 2;

        button.style.transform =
            `translate(${x * 0.12}px, ${y * 0.12}px) scale(1.03)`;

    });

    button.addEventListener("mouseleave", () => {

        button.style.transform =
            "translate(0px,0px) scale(1)";

    });

});

// =========================
// CARD HOVER FLOAT
// =========================

const cards = document.querySelectorAll(".bg-white");

cards.forEach((card) => {

    card.addEventListener("mousemove", (e) => {

        const rect = card.getBoundingClientRect();

        const x =
            e.clientX - rect.left - rect.width / 2;

        const y =
            e.clientY - rect.top - rect.height / 2;

        card.style.transform =
            `
            perspective(1000px)
            rotateX(${ -y / 25 }deg)
            rotateY(${ x / 25 }deg)
            translateY(-8px)
            scale(1.02)
            `;

    });

    card.addEventListener("mouseleave", () => {

        card.style.transform =
            `
            perspective(1000px)
            rotateX(0deg)
            rotateY(0deg)
            translateY(0px)
            scale(1)
            `;

    });

});

// =========================
// SMOOTH SCROLL
// =========================

document.documentElement.style.scrollBehavior =
    "smooth";

// =========================
// FLOATING ANIMATION LOOP
// =========================

const floatingCards =
    document.querySelectorAll(".shadow-lg");

floatingCards.forEach((card, index) => {

    let start = Date.now();

    function floatingAnimation() {

        let time =
            (Date.now() - start) / 1000;

        let y =
            Math.sin(time + index) * 4;

        card.style.transform +=
            ` translateY(${y}px)`;

        requestAnimationFrame(floatingAnimation);

    }

    floatingAnimation();

});

// =========================
// PAGE LOAD FADE
// =========================

window.addEventListener("load", () => {

    document.body.style.opacity = "1";

});

document.body.style.opacity = "0";

document.body.style.transition =
    "opacity .8s ease";

// =========================
// RIPPLE EFFECT
// =========================

buttons.forEach((button) => {

    button.style.position = "relative";

    button.style.overflow = "hidden";

    button.addEventListener("click", function (e) {

        const ripple =
            document.createElement("span");

        const rect =
            this.getBoundingClientRect();

        const size =
            Math.max(rect.width, rect.height);

        ripple.style.width =
            ripple.style.height =
            `${size}px`;

        ripple.style.position = "absolute";

        ripple.style.borderRadius = "9999px";

        ripple.style.background =
            "rgba(255,255,255,.4)";

        ripple.style.left =
            `${e.clientX - rect.left - size / 2}px`;

        ripple.style.top =
            `${e.clientY - rect.top - size / 2}px`;

        ripple.style.transform = "scale(0)";

        ripple.style.animation =
            "ripple .7s ease";

        this.appendChild(ripple);

        setTimeout(() => {

            ripple.remove();

        }, 700);

    });

});

// =========================
// RIPPLE STYLE
// =========================

const style = document.createElement("style");

style.innerHTML = `
@keyframes ripple{

    to{
        transform:scale(4);
        opacity:0;
    }

}
`;

document.head.appendChild(style);