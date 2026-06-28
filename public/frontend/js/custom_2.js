document.addEventListener("DOMContentLoaded", function() {
    const card = document.getElementById("tiltCard");
    if (window.innerWidth > 991 && card) {
        card.addEventListener("mousemove", function(e) {
            const cardRect = card.getBoundingClientRect();
            const mouseX = (e.clientX - cardRect.left) / cardRect.width - 0.5;
            const mouseY = (e.clientY - cardRect.top) / cardRect.height - 0.5;
            card.style.transform = `perspective(1000px) rotateX(${-mouseY * 8}deg) rotateY(${mouseX * 8}deg) scale3d(1.01, 1.01, 1.01)`;
        });
        card.addEventListener("mouseleave", function() {
            card.style.transform = "perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)";
        });
    }
});