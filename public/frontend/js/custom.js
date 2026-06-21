document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll(".hero-slide");
    const dots = document.querySelectorAll(".hero-indicator-dot");
    const nextBtn = document.querySelector(".hero-nav-next");
    const prevBtn = document.querySelector(".hero-nav-prev");
    
    let currentSlide = 0;
    const slideInterval = 6000; // Gambar berganti tiap 6 detik
    let autoSlideTimer;

    function showSlide(index) {
        // Hapus class active dari slide dan dot yang sekarang
        slides[currentSlide].classList.remove("active");
        dots[currentSlide].classList.remove("active");
        
        // Atur index baru (looping jika mentok)
        currentSlide = (index + slides.length) % slides.length;
        
        // Tambahkan class active ke slide dan dot baru
        slides[currentSlide].classList.add("active");
        dots[currentSlide].classList.add("active");
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
        resetTimer();
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
        resetTimer();
    }

    function resetTimer() {
        clearInterval(autoSlideTimer);
        autoSlideTimer = setInterval(nextSlide, slideInterval);
    }

    // Event Listener Tombol Navigasi
    if (nextBtn && prevBtn) {
        nextBtn.addEventListener("click", nextSlide);
        prevBtn.addEventListener("click", prevSlide);
    }

    // Event Listener Klik Indikator Dot
    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            showSlide(index);
            resetTimer();
        });
    });

    // Jalankan Timer Auto Play pertama kali
    autoSlideTimer = setInterval(nextSlide, slideInterval);
});


document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll('.stat-counter');
    const speed = 200;

    const startCounters = () => {
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(updateCount, 1);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    };

    // Trigger animasi pakai IntersectionObserver agar jalan pas di-scroll ke area stats
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    startCounters();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        const statsSection = document.querySelector('.stats-section');
        if (statsSection) observer.observe(statsSection);
    } else {
        startCounters();
    }
});